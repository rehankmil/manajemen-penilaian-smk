<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Nilai::with(['mapel', 'guru', 'murid.kelas']);

        // Filter berdasarkan mata pelajaran
        if ($request->has('mapel_id') && $request->mapel_id != '') {
            $query->where('mapel_id', $request->mapel_id);
        }

        // Filter berdasarkan guru
        if ($request->has('guru_id') && $request->guru_id != '') {
            $query->where('guru_id', $request->guru_id);
        }

        // Filter berdasarkan murid
        if ($request->has('murid_id') && $request->murid_id != '') {
            $query->where('murid_id', $request->murid_id);
        }
        
        // Filter berdasarkan kelas
        if ($request->has('kelas_id') && $request->kelas_id != '') {
            // Kita perlu melakukan join dengan tabel murid untuk memfilter berdasarkan kelas
            $query->whereHas('murid', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        // Filter berdasarkan semester
        if ($request->has('semester') && $request->semester != '') {
            $query->where('semester', $request->semester);
        }

        // Filter berdasarkan predikat
        if ($request->has('predikat') && $request->predikat != '') {
            $query->where('predikat', $request->predikat);
        }

        // Filter berdasarkan range nilai
        if ($request->has('nilai_min') && $request->nilai_min != '') {
            $query->where('nilai', '>=', $request->nilai_min);
        }
        
        if ($request->has('nilai_max') && $request->nilai_max != '') {
            $query->where('nilai', '<=', $request->nilai_max);
        }

        // Dapatkan data nilai dengan pagination
        $nilaiList = $query->latest()->paginate(10);

        // Ambil data untuk dropdown filter
        $mapelList = Mapel::all();
        $guruList = Guru::all();
        $muridList = Murid::all();
        $kelasList = Kelas::all();
        
        // Daftar semester yang tersedia
        $semesterList = ['1', '2'];
        
        // Daftar predikat yang tersedia (contoh)
        $predikatList = ['A', 'B', 'C', 'D', 'E'];

        return view('admin.nilai.nilai', compact(
            'nilaiList', 
            'mapelList', 
            'guruList', 
            'muridList', 
            'kelasList', 
            'semesterList', 
            'predikatList',
            'request'
        ), ['title' => 'Daftar Data Nilai']);
    }

    public function create()
    {
        // Ambil data untuk dropdown
        $mapelList = Mapel::all();
        $kelasList = Kelas::all();
        $guruList = Guru::with('mapel')->get();
        $muridList = Murid::with('kelas')->get();
        
        // Daftar semester yang tersedia
        $semesterList = ['1', '2'];
        
        return view('admin.nilai.tambah', compact(
            'mapelList',
            'kelasList',
            'guruList',
            'muridList',
            'semesterList'
        ), ['title' => 'Tambah Data Nilai']);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'nilai' => 'required|integer|min:0|max:100',
            'semester' => 'required|string',
            'mapel_id' => 'required|exists:mapels,id',
            'guru_id' => 'required|exists:gurus,id',
            'murid_id' => 'required|exists:murid,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Tentukan predikat berdasarkan nilai
        $predikat = $this->hitungPredikat($request->nilai);
        
        // Simpan data
        Nilai::create([
            'nilai' => $request->nilai,
            'predikat' => $predikat,
            'semester' => $request->semester,
            'mapel_id' => $request->mapel_id,
            'guru_id' => $request->guru_id,
            'murid_id' => $request->murid_id
        ]);
        
        return redirect()->route('nilai.index')
            ->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $nilai = Nilai::with(['mapel', 'guru', 'murid.kelas'])->findOrFail($id);
        
        return view('admin.nilai.detail', compact('nilai'), ['title' => 'Detail Data Nilai']);
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        
        // Ambil data untuk dropdown
        $mapelList = Mapel::all();
        $kelasList = Kelas::all();
        $guruList = Guru::with('mapel')->get();
        $muridList = Murid::with('kelas')->get();
        
        // Daftar semester yang tersedia
        $semesterList = ['1', '2'];
        
        return view('admin.nilai.ubah', compact(
            'nilai',
            'mapelList',
            'kelasList',
            'guruList',
            'muridList',
            'semesterList'
        ), ['title' => 'Edit Data Nilai']);
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'nilai' => 'required|integer|min:0|max:100',
            'semester' => 'required|string',
            'mapel_id' => 'required|exists:mapels,id',
            'guru_id' => 'required|exists:gurus,id',
            'murid_id' => 'required|exists:murid,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Cari nilai yang akan diupdate
        $nilai = Nilai::findOrFail($id);
        
        // Tentukan predikat berdasarkan nilai
        $predikat = $this->hitungPredikat($request->nilai);
        
        // Update data
        $nilai->update([
            'nilai' => $request->nilai,
            'predikat' => $predikat,
            'semester' => $request->semester,
            'mapel_id' => $request->mapel_id,
            'guru_id' => $request->guru_id,
            'murid_id' => $request->murid_id
        ]);
        
        return redirect()->route('nilai.index')
            ->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        
        return redirect()->route('nilai.index')
            ->with('success', 'Data nilai berhasil dihapus.');
    }

    private function hitungPredikat($nilai)
    {
        if ($nilai >= 90) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'B';
        } elseif ($nilai >= 70) {
            return 'C';
        } elseif ($nilai >= 60) {
            return 'D';
        } else {
            return 'E';
        }
    }

    public function getGuruByMapel(Request $request)
    {
        $mapel_id = $request->mapel_id;
        
        if (!$mapel_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID Mata Pelajaran diperlukan',
                'data' => []
            ]);
        }
        
        // Ambil guru yang mengajar mapel yang dipilih
        $guruList = Guru::where('mapel_id', $mapel_id)->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diambil',
            'data' => $guruList
        ]);
    }
    
    public function getMuridByKelas(Request $request)
    {
        $kelas_id = $request->kelas_id;
        
        if (!$kelas_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'ID Kelas diperlukan',
                'data' => []
            ]);
        }
        
        // Ambil guru yang mengajar mapel yang dipilih
        $muridList = Murid::where('kelas_id', $kelas_id)->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data murid berhasil diambil',
            'data' => $muridList
        ]);
    }
}
