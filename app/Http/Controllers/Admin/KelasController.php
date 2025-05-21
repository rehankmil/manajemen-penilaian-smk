<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        try {
            $validator = Validator::make($request->all(), [
                'kode' => 'required|string|max:10|unique:kelas,kode',
            ], [
                'kode.required' => 'Kode kelas harus diisi',
                'kode.string' => 'Kode kelas harus berupa teks',
                'kode.max' => 'Kode kelas maksimal 10 karakter',
                'kode.unique' => 'Kode kelas sudah digunakan',
            ]);
            
            if ($validator->fails()) {
                return redirect()->route('kelas.create')
                ->withErrors($validator)
                ->withInput();
            }
            
            DB::beginTransaction();
            Kelas::create([
                'kode' => $request->kode,
            ]);

            DB::commit();
            return redirect()->route('kelas.index')
                ->with('success', 'Kelas berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('kelas.create')
                ->withErrors(['kode' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.ubah', [
            'title' => 'Ubah Data Kelas',
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, Kelas $kelas)
    {
        try {
            $validator = Validator::make($request->all(), [
                'kode' => 'required|string|max:10|unique:kelas,kode,' . $kelas->id,
            ],
            [
                'kode.required' => 'Kode kelas harus diisi',
                'kode.string' => 'Kode kelas harus berupa teks',
                'kode.max' => 'Kode kelas maksimal 10 karakter',
                'kode.unique' => 'Kode kelas sudah digunakan',
            ]);
            
            if ($validator->fails()) {
                return redirect()->route('kelas.edit', $kelas->id)
                ->withErrors($validator)
                ->withInput();
            }
            
            DB::beginTransaction();
            $kelas->update([
                'kode' => $request->kode,
            ]);

            DB::commit();
            return redirect()->route('kelas.index')
                ->with('success', 'Data Kelas berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Kelas $kelas)
    {
        DB::beginTransaction();
        try {
            if ($kelas->murid()->count() > 0) {
                return redirect()->route('kelas.index')
                    ->with('error', 'Data Kelas tidak dapat dihapus karena masih memiliki murid');
            }

            $kelas->delete();

            DB::commit();
            return redirect()->route('kelas.index')
                ->with('success', 'Data Kelas berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
