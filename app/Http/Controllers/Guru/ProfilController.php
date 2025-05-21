<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::guard('guru')->user();
        return view('guru.profil.profil', [
            'title' => 'Profil Guru',
            'guru' => $user->guru
        ]);
    }

    public function edit()
    {
        $guru = Auth::guard('guru')->user();
        $avatars = [
            'img/avt/avt0.png',
            'img/avt/avt1.png',
            'img/avt/avt2.png',
            'img/avt/avt3.png',
            'img/avt/avt4.png',
        ];
        return view('guru.profil.ubahprofil', compact('avatars'), ['title' => 'Ubah Data Guru', 'guru' => $guru->guru]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'avatar' => 'required',
        ]);
        
        $authUser = Auth::guard('guru')->user();
        
        try {
            DB::table('gurus')->where('id', $authUser->guru->id)
                ->update([
                    'no_telp' => $request->no_telp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tgl_lahir' => $request->tgl_lahir,
                    'avatar' => $request->avatar,
                ]);

            return redirect()->route('guru.profil')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}