<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Murid;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MuridRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class MuridController extends Controller
{
    public function index()
    {
        $murid = Murid::with('kelas')->latest()->paginate(10);
        return view('admin.murid.murid', ['title' => 'Daftar Murid', 'murid' => $murid]);
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
            // Buat user baru
            $user = User::create([
                'username' => $request->nis,
                'password' => Hash::make($request->nis), // Default password sama dengan NIS
                'role' => 'murid'
            ]);

            // Buat murid baru dengan user_id dari user yang baru dibuat
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
            // Update data murid
            $murid->update([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'avatar' => $request->avatar,
                'kelas_id' => $request->kelas_id,
            ]);

            // Update username pada user jika NIS berubah
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
            // Simpan reference ke user terlebih dahulu
            $user = $murid->user;
            
            // Hapus data murid terlebih dahulu
            $murid->delete();
            
            // Setelah murid dihapus, baru hapus user terkait
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
