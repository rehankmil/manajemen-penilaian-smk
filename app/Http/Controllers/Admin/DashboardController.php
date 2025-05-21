<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $guru = Guru::all();
        $murid = Murid::all();

        // Mengambil data kelas dengan jumlah murid per kelas
        $kelasData = Kelas::withCount('murid')
                    ->get()
                    ->map(function ($kelas) {
                        return [
                            'kode' => $kelas->kode,
                            'jumlah_murid' => $kelas->murid_count
                        ];
                    });
        
        // Menyiapkan labels dan data untuk chart
        $labels = $kelasData->pluck('kode')->toArray();
        $data = $kelasData->pluck('jumlah_murid')->toArray();

        return view('admin.dashboard', compact('mapel', 'kelas', 'guru', 'murid', 'labels', 'data'), [
            'title' => 'Dashboard',
            'user' => $user
        ]);
    }
}