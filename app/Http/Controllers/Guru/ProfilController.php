<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Auth::guard('guru')->user();
        return view('guru.profil', [
            'title' => 'Profil Guru',
            'guru' => $profil->guru
        ]);
    }
}