<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Nilai::with(['mapel', 'guru', 'murid.kelas']);

        if ($request->has('mapel_id') && $request->mapel_id != '') {
            $query->where('mapel_id', $request->mapel_id);
        }

        if ($request->has('guru_id') && $request->guru_id != '') {
            $query->where('guru_id', $request->guru_id);
        }

        if ($request->has('murid_id') && $request->murid_id != '') {
            $query->where('murid_id', $request->murid_id);
        }
        
        if ($request->has('kelas_id') && $request->kelas_id != '') {
            $query->whereHas('murid', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        if ($request->has('semester') && $request->semester != '') {
            $query->where('semester', $request->semester);
        }

        if ($request->has('predikat') && $request->predikat != '') {
            $query->where('predikat', $request->predikat);
        }

        if ($request->has('nilai_min') && $request->nilai_min != '') {
            $query->where('nilai', '>=', $request->nilai_min);
        }
        
        if ($request->has('nilai_max') && $request->nilai_max != '') {
            $query->where('nilai', '<=', $request->nilai_max);
        }

        $nilaiList = $query->latest()->paginate(10);

        $mapelList = Mapel::all();
        $guruList = Guru::all();
        $muridList = Murid::all();
        $kelasList = Kelas::all();
        
        $semesterList = ['1', '2'];
        
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
        $mapelList = Mapel::all();
        $kelasList = Kelas::all();
        $guruList = Guru::with('mapel')->get();
        $muridList = Murid::with('kelas')->get();
        
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
        try {
            $validator = Validator::make($request->all(), [
                'nilai' => 'required|integer|min:0|max:100',
                'semester' => 'required|string',
                'mapel_id' => 'required|exists:mapels,id',
                'guru_id' => 'required|exists:gurus,id',
                'murid_id' => 'required|exists:murid,id'
            ],
            [
                'nilai.required' => 'Nilai harus diisi',
                'nilai.integer' => 'Nilai harus berupa angka',
                'nilai.min' => 'Nilai minimal adalah 0',
                'nilai.max' => 'Nilai maksimal adalah 100',
                'semester.required' => 'Semester harus diisi',
                'semester.string' => 'Semester harus berupa teks',
                'mapel_id.required' => 'Mata Pelajaran harus diisi',
                'mapel_id.exists' => 'Mata Pelajaran sudah ada',
                'guru_id.required' => 'Guru harus diisi',
                'guru_id.exists' => 'Guru sudah ada',
                'murid_id.required' => 'Murid harus diisi',
                'murid_id.exists' => 'Murid sudah ada'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            
            DB::beginTransaction();
            $predikat = $this->hitungPredikat($request->nilai);
            
            Nilai::create([
                'nilai' => $request->nilai,
                'predikat' => $predikat,
                'semester' => $request->semester,
                'mapel_id' => $request->mapel_id,
                'guru_id' => $request->guru_id,
                'murid_id' => $request->murid_id
            ]);
            
            DB::commit();
            return redirect()->route('nilai.index')
                ->with('success', 'Data nilai berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $nilai = Nilai::with(['mapel', 'guru', 'murid.kelas'])->findOrFail($id);
        
        return view('admin.nilai.detail', compact('nilai'), ['title' => 'Detail Data Nilai']);
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);

        $mapelList = Mapel::all();
        $kelasList = Kelas::all();
        $guruList = Guru::with('mapel')->get();
        $muridList = Murid::with('kelas')->get();
   
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
        try {

            $validator = Validator::make($request->all(), [
                'nilai' => 'required|integer|min:0|max:100',
                'semester' => 'required|string',
                'mapel_id' => 'required|exists:mapels,id',
                'guru_id' => 'required|exists:gurus,id',
                'murid_id' => 'required|exists:murid,id'
            ],
            [
                'nilai.required' => 'Nilai harus diisi',
                'nilai.integer' => 'Nilai harus berupa angka',
                'nilai.min' => 'Nilai minimal adalah 0',
                'nilai.max' => 'Nilai maksimal adalah 100',
                'semester.required' => 'Semester harus diisi',
                'semester.string' => 'Semester harus berupa teks',
                'mapel_id.required' => 'Mata Pelajaran harus diisi',
                'mapel_id.exists' => 'Mata Pelajaran sudah ada',
                'guru_id.required' => 'Guru harus diisi',
                'guru_id.exists' => 'Guru sudah ada',
                'murid_id.required' => 'Murid harus diisi',
                'murid_id.exists' => 'Murid sudah ada'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            
            $nilai = Nilai::findOrFail($id);
            
            $predikat = $this->hitungPredikat($request->nilai);
            
            DB::beginTransaction();
            $nilai->update([
                'nilai' => $request->nilai,
                'predikat' => $predikat,
                'semester' => $request->semester,
                'mapel_id' => $request->mapel_id,
                'guru_id' => $request->guru_id,
                'murid_id' => $request->murid_id
            ]);
            DB::commit();
            return redirect()->route('nilai.index')
                ->with('success', 'Data nilai berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
            
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
      
        $muridList = Murid::where('kelas_id', $kelas_id)->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Data murid berhasil diambil',
            'data' => $muridList
        ]);
    }
}
