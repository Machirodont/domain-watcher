<?php

namespace App\Services\CheckDomains;

use App\Models\Domain;
use App\Models\DomainCheckLog;
use Exception;
use Illuminate\Support\Facades\Http;

class DomainChecker
{
    public function check(Domain $domain): DomainCheckLog
    {
        $log = new DomainCheckLog();
        $log->domain_id = $domain->id;
        $log->status = DomainCheckStatus::STARTED;
        $log->error = '';
        $log->save();
        try {
            $response = Http::timeout(5)->connectTimeout(3)->get($domain->url);
            $log->status = DomainCheckStatus::FINISHED;
            $log->code = $response->status();
            $log->content_size = strlen($response->body());
        } catch (Exception $e) {
            $log->status = DomainCheckStatus::ERROR;
            $log->error = $e->getMessage();
        }
        $log->save();

        return $log;
    }
}
