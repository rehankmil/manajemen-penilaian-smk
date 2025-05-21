<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Requests\GuruRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'latest');
        
        $query = Guru::with('mapel');
        
        switch ($sort) {
            case 'asc':
                $query->orderBy('nama', 'asc');
                break;
            case 'desc':
                $query->orderBy('nama', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }
        
        $gurus = $query->paginate(10)->withQueryString();
        
        return view('admin.guru.guru', [
            'title' => 'Daftar Guru', 
            'gurus' => $gurus,
            'sort' => $sort
        ]);
    }
    
    public function create()
    {
        $mapels = Mapel::all();
        $avatars = [
            'img/avt/avt0.png',
            'img/avt/avt1.png',
            'img/avt/avt2.png',
            'img/avt/avt3.png',
            'img/avt/avt4.png',
        ];
        return view('admin.guru.tambah', compact('mapels', 'avatars'), ['title' => 'Tambah Data Guru']);
    }
    
    public function store(GuruRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->nip,
                'password' => Hash::make($request->password),
                'role' => 'guru'
            ]);

            Guru::create([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'avatar' => $request->avatar,
                'mapel_id' => $request->mapel_id,
                'user_id' => $user->id
            ]);

            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    public function show(Guru $guru)
    {
        Auth::guard('admin')->check();
        return view('admin.guru.detail', compact('guru'), [
            'title' => 'Detail Guru'
        ]);
    }
    
    public function edit(Guru $guru)
    {
        $mapels = Mapel::all();
        $avatars = [
            'img/avt/avt0.png',
            'img/avt/avt1.png',
            'img/avt/avt2.png',
            'img/avt/avt3.png',
            'img/avt/avt4.png',
        ];
        return view('admin.guru.ubah', compact('guru', 'mapels', 'avatars'), ['title' => 'Ubah Data Guru']);
    }

    public function update(GuruRequest $request, Guru $guru)
    {
        DB::beginTransaction();
        try {
            $guru->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_lahir' => $request->tgl_lahir,
                'avatar' => $request->avatar,
                'mapel_id' => $request->mapel_id,
            ]);

            if ($guru->nip != $request->nip) {
                $guru->user->update([
                    'username' => $request->nip
                ]);
            }

            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Guru $guru)
    {
        DB::beginTransaction();
        try {
            $user = $guru->user;
            
            $guru->delete();
            
            if ($user) {
                $user->delete();
            }
            
            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
