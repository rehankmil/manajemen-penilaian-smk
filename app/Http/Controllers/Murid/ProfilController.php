<?php

namespace App\Http\Controllers\Murid;
use App\Models\Kelas;

use App\Models\Murid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MuridRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Auth::guard('murid')->user();
        return view('murid.profil', [
            'title' => 'Profil Murid',
            'murid' => $profil->murid
        ]);
    }

    public function edit()
    {
        $murid = Auth::guard('murid')->user();
        $kelas = Kelas::all();
        $avatars = [
            'img/avt/avt0.png',
            'img/avt/avt1.png',
            'img/avt/avt2.png',
            'img/avt/avt3.png',
            'img/avt/avt4.png',
        ];
        return view('murid.ubahprofil', compact('kelas', 'avatars'), ['title' => 'Ubah Data Murid', 'murid' => $murid->murid]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'avatar' => 'required',
        ]);
        
        $authUser = Auth::guard('murid')->user();
        
        try {
            DB::table('murid')->where('id', $authUser->murid->id)
                ->update([
                    'no_telp' => $request->no_telp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tgl_lahir' => $request->tgl_lahir,
                    'avatar' => $request->avatar,
                ]);
                
            return redirect()->route('murid.profil')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}