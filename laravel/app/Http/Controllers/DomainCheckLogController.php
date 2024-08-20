<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DomainCheckLogController extends Controller
{
    public function index(int $domainId, Request $request): View
    {
        $domain = Domain::query()->findOrFail($domainId);

        return view('domain_check_log.list', [
            'domain_id' => $domainId,
            'logs' => $domain->logs()->orderByDesc('created_at')->paginate(100),
        ]);
    }
}
