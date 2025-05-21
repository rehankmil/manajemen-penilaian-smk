<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserAuthVerifyRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', ['title' => 'Masuk Akun']);
    }

    public function verify(UserAuthVerifyRequest $request)
    {
        $data = $request->validated();
        $remember = $request->has('remember');

        if(Auth::guard('admin')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'admin'], $remember))
        {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        else if(Auth::guard('guru')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'guru'], $remember))
        {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-g');
        }
        else if(Auth::guard('murid')->attempt(['username' => $data['username'], 'password' => $data['password'], 'role' => 'murid'], $remember))
        {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-m');
        }
        else
        {
            return redirect(route('login'))->with('msg', 'NIP/NIS atau Kata Sandi yang dimasukkan tidak valid!');
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