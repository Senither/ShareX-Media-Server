<?php

namespace App\Http\Controllers;

use App\Models\User;

class ImposterController extends Controller
{
    /**
     * Joins the user as an imposter.
     *
     * @param  \App\Models\User   $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function join(User $user)
    {
        session()->put('imposter_id', $user->id);

        return redirect()->route('dashboard');
    }

    /**
     * Leaves imposter session and returns to the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function leave()
    {
        session()->remove('imposter_id');

        return redirect()->route('control-panel');
    }
}
