<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.kelas', ['title' => 'Data Kelas', 'kelas' => $kelas]);
    }

    public function create()
    {
        return view('admin.kelas.tambah', [
            'title' => 'Tambah Kelas'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:kelas,kode',
        ]);

        if ($validator->fails()) {
            return redirect()->route('kelas.create')
                ->withErrors($validator)
                ->withInput();
        }

        Kelas::create([
            'kode' => $request->kode,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kelas)
    {
        // dd($kelas);
        return view('admin.kelas.ubah', [
            'title' => 'Ubah Data Kelas',
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|max:10|unique:kelas,kode,' . $kelas->id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('kelas.edit', $kelas->id)
                ->withErrors($validator)
                ->withInput();
        }

        $kelas->update([
            'kode' => $request->kode,
        ]);

        return redirect()->route('kelas.index')
            ->with('success', 'Data Kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kelas)
    {
        if ($kelas->murid->count() > 0) {
            return redirect()->route('kelas.index')
                ->with('error', 'Data Kelas tidak dapat dihapus karena masih memiliki murid');
        }

        $kelas->delete();
        return redirect()->route('kelas.index')
            ->with('success', 'Data Kelas berhasil dihapus');
    }
}
