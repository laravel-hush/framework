<?php

namespace ScaryLayer\Hush\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function get()
    {
        return view('hush::login');
    }

    public function post()
    {
        if (Auth::attempt(request()->only('email', 'password'), true)) {
            $redirectTo = session('redirect-to', route('admin.index'));
            session()->flash('redirect-to');
            return redirect($redirectTo);
        }

        return back()->withErrors(['email' => __('hush::admin.admin-does-not-exists')]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.index');
    }
}
