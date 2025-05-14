<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserAuthVerifyRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function verify(UserAuthVerifyRequest $request)
    {
        $data = $request->validated();
        
        if(Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'admin']))
        {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        else if(Auth::guard('guru')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'guru']))
        {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-g');
        }
        else if(Auth::guard('murid')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'murid']))
        {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-m');
        }
        else
        {
            abort(403, 'Unauthorized');
            return redirect(route('login'))->with('msg', 'Data yang dimasukkan tidak valid!');
        }
    }

    public function logout()
    {
        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
        }
        else if(Auth::guard('guru')->check())
        {
            Auth::guard('guru')->logout();
        }
        else if(Auth::guard('murid')->check())
        {
            Auth::guard('murid')->logout();
        }

        return redirect(route('login'));
    }
}