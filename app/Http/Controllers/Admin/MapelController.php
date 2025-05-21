<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::paginate(4);
        return view('admin.mapel.mapel', ['title' => 'Data Mata Pelajaran', 'mapel' => $mapel]);
    }

    public function create()
    {
        return view('admin.mapel.tambah', [
            'title' => 'Tambah Data Mata Pelajaran'
        ]);
    }

    public function store(Request $request)
    {
        // Validasi terlebih dahulu sebelum memulai transaction
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:mapels,kode',
            'nama' => 'required|string',
        ],
        [
            'kode.required' => 'Kode Mata Pelajaran harus diisi',
            'kode.string' => 'Kode Mata Pelajaran harus berupa teks',
            'kode.max' => 'Kode Mata Pelajaran maksimal 10 karakter',
            'kode.unique' => 'Kode Mata Pelajaran sudah digunakan',
            'nama.required' => 'Nama Mata Pelajaran harus diisi',
            'nama.string' => 'Nama Mata Pelajaran harus berupa teks',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            Mapel::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
            ]);

            DB::commit();
            return redirect()->route('mapel.index')
                ->with('success', 'Mata Pelajaran berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit(Mapel $mapel)
    {
        return view('admin.mapel.ubah', [
            'title' => 'Ubah Data Mata Pelajaran',
            'mapel' => $mapel
        ]);
    }

    public function update(Request $request, Mapel $mapel)
    {
        try {
            $validator = Validator::make($request->all(), [
                'kode' => 'required|string|max:10|unique:mapels,kode,' . $mapel->id,
                'nama' => 'required|string|max:10' . $mapel->id,
            ],
            [
                'kode.required' => 'Kode kelas harus diisi',
                'kode.string' => 'Kode kelas harus berupa teks',
                'kode.max' => 'Kode kelas maksimal 10 karakter',
                'kode.unique' => 'Kode kelas sudah digunakan',
                'nama.required' => 'Kode kelas harus diisi',
                'nama.string' => 'Kode kelas harus berupa teks',
                'nama.max' => 'Kode kelas maksimal 10 karakter',
                
            ]);
            
            if ($validator->fails()) {
                return redirect()->route('mapel.edit', $mapel->id)
                ->withErrors($validator)
                ->withInput();
            }
            
            DB::beginTransaction();
            $mapel->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
            ]);

            DB::commit();
            return redirect()->route('mapel.index')
                ->with('success', 'Data Mata Pelajaran berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Mapel $mapel)
    {
        DB::beginTransaction();
        try {
            if ($mapel->guru->count() > 0) {
                return redirect()->route('mapel.index')
                    ->with('error', 'Data Mata Pelajaran tidak dapat dihapus karena masih memiliki guru');
            }

            $mapel->delete();

            DB::commit();
            return redirect()->route('mapel.index')
                ->with('success', 'Data Mata Pelajaran berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
