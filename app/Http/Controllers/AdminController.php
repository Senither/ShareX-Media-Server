<?php

namespace App\Http\Controllers;

use App\User;
use App\Settings;
use App\Http\Requests;
use App\Http\Requests\SiteRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('group')
                     ->orderBy('group_id')
                     ->orderBy('username')
                     ->paginate(10);

        return view('admin.dashboard', compact('users'));
    }

    public function update(SiteRequest $request)
    {
        $this->settings()->name        = $request->get('name');
        $this->settings()->per_page    = $request->get('per_page');
        $this->settings()->live_day    = $request->get('live_day');
        $this->settings()->live_hour   = $request->get('live_hour');
        $this->settings()->live_minute = $request->get('live_minute');
        $this->settings()->save();

        flash()->success(
            'The site settings has been updated successfully!', null
        );

        return redirect()->action('AdminController@index');
    }
}
