<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Murid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MuridRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MuridController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $query = Murid::with('kelas')->search($search);
        
        $murid = $query->latest()->paginate(10);
        
        $murid->appends(['search' => $search]);
        
        return view('admin.murid.murid', [
            'title' => 'Daftar Murid', 
            'murid' => $murid,
            'search' => $search
        ]);
    }

    public function create()
    {
        $kelas = Kelas::all();
        $avatars = [
            'img/avt/avt0.png',
            'img/avt/avt1.png',
            'img/avt/avt2.png',
            'img/avt/avt3.png',
            'img/avt/avt4.png',
        ];
        return view('admin.murid.tambah', compact('kelas', 'avatars'), ['title' => 'Tambah Data Murid']);
    }

    public function store(MuridRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->nis,
                'password' => Hash::make($request->password),
                'role' => 'murid'
            ]);

            Murid::create([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'avatar' => $request->avatar,
                'kelas_id' => $request->kelas_id,
                'user_id' => $user->id
            ]);

            DB::commit();
            return redirect()->route('murid.index')->with('success', 'Data murid berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    public function show(Murid $murid)
    {
        return view('admin.murid.detail', compact('murid'), [
            'title' => 'Detail Murid'
        ]);
    }

    public function edit(Murid $murid)
    {
        $kelas = Kelas::all();
        $avatars = [
            'img/avt/avt0.png',
            'img/avt/avt1.png',
            'img/avt/avt2.png',
            'img/avt/avt3.png',
            'img/avt/avt4.png',
        ];
        return view('admin.murid.ubah', compact('murid', 'kelas', 'avatars'), ['title' => 'Ubah Data Murid']);
    }

    public function update(MuridRequest $request, Murid $murid)
    {
        DB::beginTransaction();
        try {
            $murid->update([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'avatar' => $request->avatar,
                'kelas_id' => $request->kelas_id,
            ]);

            if ($murid->nis != $request->nis) {
                $murid->user->update([
                    'username' => $request->nis
                ]);
            }

            DB::commit();
            return redirect()->route('murid.index')->with('success', 'Data murid berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Murid $murid)
    {
        DB::beginTransaction();
        try {
            $user = $murid->user;
            
            $murid->delete();
            
            if ($user) {
                $user->delete();
            }
            
            DB::commit();
            return redirect()->route('murid.index')->with('success', 'Data murid berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
