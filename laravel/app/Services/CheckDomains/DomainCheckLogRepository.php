<?php

namespace App\Services\CheckDomains;

use App\Models\DomainCheckLog;
use Carbon\Carbon;

class DomainCheckLogRepository
{
    private const LOGS_LIFE_TIME_HOURS = 7 * 24;

    public function getCheckLogSummary(int $domainId, int $depth): CheckLogSummaryDto
    {
        $logs = $this->getLastLogs($domainId, $depth);

        $summary = new CheckLogSummaryDto(count($logs));

        if (count($logs) === 0) {
            return $summary;
        }
        $summary->isLastCheckSuccess = $logs[0]->code === 200;
        $solidSequenceBreak = false;
        foreach ($logs as $log) {
            $isSuccess = $log->code === 200;

            if ($summary->isLastCheckSuccess !== $isSuccess) {
                $solidSequenceBreak = true;
            }

            if (!$solidSequenceBreak) {
                $summary->solidSequenceCount++;
            }

            if (!$isSuccess) {
                $summary->failCount++;
            }
        }

        return $summary;
    }

    /**
     * @param int $domainId
     * @param int $depth
     * @return DomainCheckLog[]
     */
    public function getLastLogs(int $domainId, int $depth): array
    {
        return DomainCheckLog::query()
            ->where('domain_id', '=', $domainId)
            ->orderBy('created_at', 'desc')
            ->limit($depth)
            ->get()->all();
    }

    public function clearOldLogs(): void
    {
        DomainCheckLog::query()
            ->where('created_at', '<', Carbon::now()->subHours(self::LOGS_LIFE_TIME_HOURS))
            ->delete();
    }

}
