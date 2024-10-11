<?php

namespace App\Console\Commands;

use App\Services\CheckDomains\DomainCheckLogRepository;
use Illuminate\Console\Command;

class ClearOldLogs extends Command
{
    protected $signature = 'app:clear-old-logs';

    protected $description = 'Clear old logs';

    public function handle(
        DomainCheckLogRepository $domainCheckLogRepository,
    )
    {
        $domainCheckLogRepository->clearOldLogs();
    }
}
