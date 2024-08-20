<?php

namespace App\Services\CheckDomains;

use App\Models\Domain;
use App\Models\DomainCheckLog;

class CheckDomainService
{
    /**
     * Время, в течение которого проверяется долгосрочная стабильность сайта
     */
    public const STABILITY_CHECK_DEPTH = 36;

    public const GO_ONLINE_THRESHOLD = 3;

    public const GO_OFFLINE_THRESHOLD = 3;

    /**
     * Доля проваленных проверок, при превышении которой сайт отправляется в OFFLINE
     */
    public const ONLINE_STABILITY_THRESHOLD = 0.2;

    /**
     * Доля проваленных проверок, при которой сайт все-таки можно отправлять в ONLINE
     */
    public const RECOVERY_THRESHOLD = 0.1;

    public function __construct(
        private readonly DomainCheckLogRepository $checkLogRepository,
    ) {
    }

    public function needTurnOnline(Domain $domain, DomainCheckLog $log): bool
    {
        if ($domain->status === DomainStatus::UNCHECKED && $log->code === 200) {
            return true;
        }

        if ($domain->status === DomainStatus::OFFLINE && $log->code === 200) {
            $checkLogSummary = $this->checkLogRepository->getCheckLogSummary($domain->id, self::STABILITY_CHECK_DEPTH);
            if (
                $checkLogSummary->isLastCheckSuccess
                && $checkLogSummary->solidSequenceCount >= self::GO_ONLINE_THRESHOLD
                && ($checkLogSummary->failCount / $checkLogSummary->totalCount) <= self::RECOVERY_THRESHOLD
            ) {
                return true;
            }
        }

        return false;
    }

    public function needTurnOffline(Domain $domain, DomainCheckLog $log): bool
    {
        if ($log->code === 200) {
            return false;
        }

        if ($domain->status === DomainStatus::UNCHECKED) {
            return true;
        }

        if ($domain->status === DomainStatus::ONLINE) {
            $checkLogSummary = $this->checkLogRepository->getCheckLogSummary($domain->id, self::STABILITY_CHECK_DEPTH);
            if ($checkLogSummary->isLastCheckSuccess) {
                return false;
            }

            if (
                $checkLogSummary->solidSequenceCount >= self::GO_OFFLINE_THRESHOLD
                || ($checkLogSummary->failCount / $checkLogSummary->totalCount) > self::ONLINE_STABILITY_THRESHOLD
            ) {
                return true;
            }
        }

        return false;
    }

}
