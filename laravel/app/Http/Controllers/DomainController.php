<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\DomainGroup;
use App\Services\CheckDomains\DomainStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(Request $request): View
    {
        return view('domain.list', [
            'domains' => Domain::query()->get()->all()
        ]);
    }

    public function editForm(Request $request): View
    {
        $modelId = (int)$request->get('id');

        if ($modelId > 0) {
            $model = Domain::query()->findOrFail($modelId);
        } else {
            $model = new Domain();
        }

        return view('domain.edit_form', [
            'domain' => $model,
            'groups' => DomainGroup::query()->get()->all()
        ]);
    }

    public function edit(Request $request): RedirectResponse
    {
        $modelId = (int)$request->post('id');

        if ($modelId > 0) {
            $model = Domain::query()->findOrFail($modelId);
        } else {
            $model = new Domain();
            $model->last_check_at = null;
            $model->status = DomainStatus::UNCHECKED;
            $model->check_rate = 10;
        }

        $model->url = $request->post('url');
        $model->group_id = $request->post('group_id');

        $model->save();

        return to_route('domain.list', ['id' => $model]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $modelId = (int)$request->post('id');
        $model = Domain::query()->findOrFail($modelId);

        if (is_null($model)) {
            return to_route('domain.list');
        }

        $model->logs()->delete();
        $model->status = DomainStatus::UNCHECKED;
        $model->last_check_at = null;
        $model->offline_since = null;
        $model->save();

        return to_route('domain.list', ['id' => $model]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $modelId = (int)$request->post('id');
        if ($modelId <= 0) {
            return to_route('domain.list');
        }

        $model = Domain::query()->findOrFail($modelId);
        $model->delete();


        return to_route('domain.list');
    }
}
