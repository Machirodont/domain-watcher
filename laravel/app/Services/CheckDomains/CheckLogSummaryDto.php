<?php

namespace App\Services\CheckDomains;

class CheckLogSummaryDto
{
    public function __construct(
        public int  $totalCount,
        public bool $isLastCheckSuccess = false,
        public int $solidSequenceCount = 0,
        public float $failCount = 0,
    ) {
    }

}
