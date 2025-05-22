<?php

namespace App\Http\Controllers\Guru;
use App\Models\Guru;

use App\Models\Kelas;
use App\Models\Murid;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $user = Auth::guard('guru')->user();
        $guru = $user->guru;
        $kelas = Kelas::all();
        return view('guru.penilaian.kelas', compact('kelas', 'guru'), ['title' => 'Daftar Kelas']);
    }

    public function daftarMurid($kelasId)
    {
        $user = Auth::guard('guru')->user();
        $guru = $user->guru;
        
        // Mendapatkan informasi kelas
        $kelas = Kelas::findOrFail($kelasId);
        
        // Mendapatkan daftar murid di kelas tersebut
        $muridList = Murid::where('kelas_id', $kelasId)
            ->select('id', 'nis', 'nama')
            ->get();
        
        // Mendapatkan mapel yang diajar oleh guru
        $mapel = $guru->mapel;
        
        return view('guru.penilaian.murid', compact('muridList', 'kelas', 'guru', 'mapel'), ['title' => 'Daftar Murid']);
    }

    public function daftarNilai($muridId)
    {
        $user = Auth::guard('guru')->user();
        $guru = $user->guru;
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai guru');
        }
        
        // Mendapatkan data murid
        $murid = Murid::findOrFail($muridId);
        
        // Mendapatkan mapel yang diajar oleh guru
        $mapel = $guru->mapel;
        
        // Mendapatkan semua nilai untuk murid dan mapel ini
        $nilaiList = Nilai::where('murid_id', $muridId)
            ->where('mapel_id', $mapel->id)
            ->where('guru_id', $guru->id)
            ->get();
        
        return view('guru.penilaian.nilai', compact('murid', 'guru', 'mapel', 'nilaiList'), ['title' => 'Daftar Nilai']);
    }

    public function formNilai($muridId)
    {
        $user = Auth::guard('guru')->user();
        $guru = $user->guru;
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai guru');
        }
        
        // Mendapatkan data murid
        $murid = Murid::findOrFail($muridId);
        
        // Mendapatkan mapel yang diajar oleh guru
        $mapel = $guru->mapel;

        $semesterList = ['1', '2'];
        
        // Cek apakah nilai sudah ada untuk murid dan mapel ini
        $nilai = Nilai::where('murid_id', $muridId)
            ->where('mapel_id', $mapel->id)
            ->where('guru_id', $guru->id)
            ->first();
        
        return view('guru.penilaian.tambah', compact('murid', 'guru', 'mapel', 'nilai', 'semesterList'), ['title' => 'Tambah Nilai Siswa']);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'semester' => 'required|string',
            'murid_id' => 'required|exists:murid,id',
        ]);
        
        $user = Auth::guard('guru')->user();
        $guru = $user->guru;
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai guru');
        }
        
        // Mendapatkan mapel yang diajar oleh guru
        $mapel = $guru->mapel;
        
        // Menentukan predikat berdasarkan nilai
        $predikat = $this->hitungPredikat($request->nilai);
        
        // Cek apakah nilai sudah ada untuk murid dan mapel ini
        $nilaiExist = Nilai::where('murid_id', $request->murid_id)
            ->where('mapel_id', $mapel->id)
            ->where('guru_id', $guru->id)
            ->where('semester', $request->semester)
            ->first();
        
        if ($nilaiExist) {
            return redirect()->back()->with('error', 'Nilai untuk murid ini pada semester tersebut sudah ada');
        }
        
        // Simpan nilai baru
        Nilai::create([
            'nilai' => $request->nilai,
            'predikat' => $predikat,
            'semester' => $request->semester,
            'mapel_id' => $mapel->id,
            'guru_id' => $guru->id,
            'murid_id' => $request->murid_id,
        ]);
        
        return redirect()->route('guru.penilaian.daftar-nilai', $request->murid_id)
            ->with('success', 'Nilai berhasil ditambahkan');
    }

    public function edit($nilaiId)
    {
        $user = Auth::guard('guru')->user();
        $guru = $user->guru;

        // dd($guru);
        
        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Anda tidak memiliki akses sebagai guru');
        }

        
        // Mendapatkan nilai yang akan diedit
        $nilai = Nilai::findOrFail($nilaiId);

        
        // Memastikan guru hanya dapat mengedit nilai untuk mapel yang diajarnya
        if ($nilai->guru_id != $guru->id || $nilai->mapel_id != $guru->mapel_id) {
            return redirect()->route('guru.penilaian.index')->with('error', 'Anda tidak memiliki akses untuk mengedit nilai ini');
        }
        
        // Mendapatkan data murid
        $murid = $nilai->murid;
        
        // Mendapatkan mapel yang diajar oleh guru
        $mapel = $guru->mapel;

        $semesterList = ['1', '2'];
        
        return view('guru.penilaian.ubah', compact('nilai', 'murid', 'guru', 'mapel', 'semesterList'), ['title' => 'Ubah Nilai Siswa']);
    }
    
    public function update(Request $request, $nilaiId)
    {
        // Validasi input
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'semester' => 'required|string',
        ]);
        
        $user = Auth::guard('guru')->user();
        $guru = $user->guru;
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai guru');
        }
        
        // Mendapatkan nilai yang akan diupdate
        $nilai = Nilai::findOrFail($nilaiId);
        
        // Memastikan guru hanya dapat mengupdate nilai untuk mapel yang diajarnya
        if ($nilai->guru_id != $guru->id || $nilai->mapel_id != $guru->mapel_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengupdate nilai ini');
        }
        
        // Menentukan predikat berdasarkan nilai baru
        $predikat = $this->hitungPredikat($request->nilai);
        
        // Update nilai
        $nilai->update([
            'nilai' => $request->nilai,
            'predikat' => $predikat,
            'semester' => $request->semester,
        ]);
        
        return redirect()->route('guru.penilaian.daftar-nilai', $nilai->murid_id)
            ->with('success', 'Nilai berhasil diupdate');
    }
    
    public function destroy($nilaiId)
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai guru');
        }

        $nilai = Nilai::findOrFail($nilaiId);
        
        if ($nilai->guru_id != $guru->id || $nilai->mapel_id != $guru->mapel_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus nilai ini');
        }
        
        $muridId = $nilai->murid_id;
        
        $nilai->delete();
        
        return redirect()->route('guru.penilaian.daftar-nilai', $muridId)
            ->with('success', 'Nilai berhasil dihapus');
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
}
