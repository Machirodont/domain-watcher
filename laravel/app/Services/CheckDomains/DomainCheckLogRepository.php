<?php

namespace App\Services\CheckDomains;

use App\Models\DomainCheckLog;

class DomainCheckLogRepository
{

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

}
