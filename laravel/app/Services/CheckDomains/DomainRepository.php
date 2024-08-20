<?php

namespace App\Services\CheckDomains;

use App\Models\Domain;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DomainRepository
{
    /**
     * @return Domain[]
     */
    public function getDomainsThatTimeToCheck(): array
    {
        $now = Carbon::now();
        return Domain::query()
            ->select(['*', DB::raw('TIMESTAMPDIFF(MINUTE, last_check_at, "' . $now . '") - check_rate AS check_lag')])
            ->orderByDesc('check_lag')
            ->having('check_lag', '>', 0)
            ->orHavingNull('check_lag')
            ->get()
            ->all();
    }

    public function getReplacementForDomain(Domain $domain): ?Domain
    {
        return Domain::query()
            ->where('group_id', $domain->group_id)
            ->where('status', DomainStatus::ONLINE)
            ->orderByDesc('created_at')
            ->first();
    }

    public function goOnline(Domain $domain): void
    {
        $domain->status = DomainStatus::ONLINE;
        $domain->offline_since = null;
        $domain->last_check_at = Carbon::now();
        $domain->save();
    }

    public function goOffline(Domain $domain): void
    {
        if ($domain->status !== DomainStatus::OFFLINE) {
            $domain->offline_since = Carbon::now();
        }
        $domain->status = DomainStatus::OFFLINE;
        $domain->last_check_at = Carbon::now();
        $domain->save();
    }
}
