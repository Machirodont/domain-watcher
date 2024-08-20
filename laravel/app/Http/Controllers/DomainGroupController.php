<?php

namespace App\Http\Controllers;

use App\Models\DomainGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DomainGroupController extends Controller
{
    public function index(Request $request): View
    {
        return view('domain_group.list', [
            'groups' => DomainGroup::query()->get()->all()
        ]);
    }

    public function editForm(Request $request): View
    {
        $modelId = (int)$request->get('id');

        if ($modelId > 0) {
            $model = DomainGroup::query()->findOrFail($modelId);
        } else {
            $model = new DomainGroup();
        }

        return view('domain_group.edit_form', [
            'group' => $model,
        ]);
    }

    public function edit(Request $request): RedirectResponse
    {
        $modelId = (int)$request->post('id');

        if ($modelId > 0) {
            $model = DomainGroup::query()->findOrFail($modelId);
        } else {
            $model = new DomainGroup();
        }

        $model->name = $request->post('name');

        $model->save();

        return to_route('domain_group.list', ['id' => $model]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $modelId = (int)$request->post('id');
        if ($modelId <= 0) {
            return to_route('domain_group.list');
        }

        $model = DomainGroup::query()->findOrFail($modelId);
        if ($model->domains()->count() === 0) {
            $model->delete();
        }

        return to_route('domain_group.list');
    }
}
