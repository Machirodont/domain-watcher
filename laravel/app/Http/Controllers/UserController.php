<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        return view('user.list', [
            'users' => User::query()->orderByDesc('created_at')->get()->all()
        ]);
    }

    public function activate(Request $request): RedirectResponse
    {
        $request->validate(['user_id' => 'required|integer']);
        $userId = $request->post('user_id');
        /** @var User $user */
        $user = User::query()->where('id', '=', $userId)->firstOrFail();
        $user->activated_at = Carbon::now();
        $user->save();

        return to_route('user.list');
    }

    public function deactivate(Request $request): RedirectResponse
    {
        $request->validate(['user_id' => 'required|integer']);
        $userId = $request->post('user_id');
        /** @var User $user */
        $user = User::query()->where('id', '=', $userId)->firstOrFail();

        if ($user->isAdmin()) {
            return to_route('user.list');
        }

        $user->activated_at = null;
        $user->save();
        return to_route('user.list');
    }
}
