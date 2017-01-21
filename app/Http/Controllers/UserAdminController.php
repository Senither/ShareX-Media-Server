<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    public function create()
    {
        if (! Auth::user()->hasPermission('user.create')) {
            return abort(401);
        }
        
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_num|between:2,128|unique:users,username',
            'group'    => 'required|numeric|exists:groups,id'
        ]);

        if (! Auth::user()->hasPermission('user.create')) {
            return redirect()->action('AdminController@index');
        }

        if (! Auth::user()->hasPermission('user.create.group.'.$request->get('group'))) {
            return redirect()->back()
                             ->withErrors(['group' => 'You do you have permission to create a user with a group id of '.$request->get('group')]);
        }

        $password = str_random(rand(0, 6) + 10);

        User::create([
            'group_id' => $request->get('group'),
            'username' => $request->get('username'),
            'password' => $password,
            'token'    => str_random(62)
        ]);

        flash()->success(
            'The account has been created successfully!',
            'The account "'.$request->get('username').'" has been created successfully! The users temporary password is <i>'.$password.'</i>'
        );

        return redirect()->action('AdminController@index');
    }

    public function edit(User $user)
    {
        if (! Auth::user()->hasPermission('user.edit.group.'.$user->group->id)) {
            return abort(401);
        }

        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where([
            'id'         => $request->get('_userid'),
            'created_at' => Carbon::createFromFormat(Carbon::DEFAULT_TO_STRING_FORMAT, $request->get('_usercd')),
        ])->first();

        if ($user == null) {
            return redirect()
                ->back()
                ->withErrors([
                    'user' => 'Missmatching user verification details given! Editing the source code... Bad dev!'
                ]);
        }

        // Updating Group
        if (Auth::user()->hasPermission('user.edit.group.'.$request->get('group'))) {
            $this->validate($request, [
                'group' => 'required|numeric|exists:groups,id'
            ]);

            $user->group_id = $request->get('group');
        }

        // Updating Username
        if (Auth::user()->hasPermission('user.edit.username')) {
            $this->validate($request, [
                'username' => 'required|alpha_num|between:2,128'.($request->get('username') == $user->username ? null : '|unique:users,username'),
            ]);

            $user->username = $request->get('username');
        }

        // Updating Password
        if (Auth::user()->hasPermission('user.edit.password') && mb_strlen($request->get('password')) != 0) {
            $this->validate($request, [
                'password'       => 'required|same:password_again|min:4',
                'password_again' => 'required'
            ]);

            $user->password = $request->get('password');
        }

        $user->save();
        flash()->success('Account updated successfully!', $user->username.'\'s account has been updated successfully!');

        return redirect()->action('UserAdminController@edit', [$user->username]);
    }

    public function showDelete(User $user)
    {
        if (! Auth::user()->hasPermission('user.edit.group.'.$user->group->id) || $user->super) {
            return abort(401);
        }

        return view('user.delete', compact('user'));
    }

    public function destory(User $user)
    {
        DB::table('sessions')->where('user_id', $user->id)->delete();

        foreach ($user->images as $image) {
            $image->delete();
        }

        $user->delete();
        flash()->success(
            'Account deleted successfully!',
            'The account <i>'.$user->username.'</i> and <i>'.$user->images->count().'</i> images has been deleted successfully!'
        );

        return redirect()->action('AdminController@index');
    }
}
