<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:mapels,kode',
            'nama' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('mapel.create')
                ->withErrors($validator)
                ->withInput();
        }

        Mapel::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('mapel.index')
            ->with('success', 'Kelas berhasil ditambahkan');
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
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:mapels,kode,' . $mapel->id,
            'nama' => 'required|string|max:10' . $mapel->id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('mapel.edit', $mapel->id)
                ->withErrors($validator)
                ->withInput();
        }

        $mapel->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return redirect()->route('mapel.index')
            ->with('success', 'Data Kelas berhasil diperbarui');
    }

    public function destroy(Mapel $mapel)
    {
        if ($mapel->guru->count() > 0) {
            return redirect()->route('mapel.index')
                ->with('error', 'Data Mata Pelajaran tidak dapat dihapus karena masih memiliki guru');
        }

        $mapel->delete();
        return redirect()->route('mapel.index')
            ->with('success', 'Data Mata Pelajaran berhasil dihapus');
    }
}
