<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class UserController extends Controller
{
    use ThrottlesLogins;

    public function show()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->clearLoginAttempts($request);

            flash()->success(
                'Welcome back '.Auth::user()->username.'!', null
            );

            return redirect()->intended(action('AdminController@index'));
        }

        $this->incrementLoginAttempts($request);

        $message = Lang::get('auth.failed');

        return redirect()->action('UserController@show')
            ->withErrors([$this->username() => $message]);
    }

    protected function attemptLogin(Request $request)
    {
        $loggedIn = Auth::attempt([
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ]);

        if ($loggedIn && Hash::needsRehash(Auth::user()->password)) {
            Auth::user()->password = $request->get('password');
            Auth::user()->save();
        }

        return $loggedIn;
    }

    protected function username()
    {
        return 'username';
    }

    public function updateToken()
    {
        $user = Auth::user();
        $user->token = str_random(62);
        $user->save();

        return redirect('AdminController@index');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|same:new_password_again|min:4',
            'new_password_again' => 'required'
        ]);

        if (! Hash::check($request->get('password'), Auth::user()->password)) {
            return redirect()->back()->withErrors([
                'password' => 'The provided password does not match your current credentials'
            ]);
        }

        Auth::user()->password = $request->get('new_password');
        Auth::user()->save();

        flash()->success(
            'Account updated successfully!', 
            'Your account password has been updated successfully.'
        );

        return redirect()->back();
    }

    public function destory()
    {
        Auth::logout();

        return redirect()->action('HomeController');
    }
}
