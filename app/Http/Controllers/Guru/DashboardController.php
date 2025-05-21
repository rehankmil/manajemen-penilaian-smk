<?php

namespace App\Http\Controllers\Guru;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $murid = Murid::all();
        return view('guru.dashboard', compact('mapel', 'kelas', 'murid'), [
            'title' => 'Dashboard',
            'guru' => $guru->guru
        ]);
    }
}
