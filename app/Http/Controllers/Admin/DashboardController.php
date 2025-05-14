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
        return view('admin.dashboard', compact('mapel', 'kelas', 'guru', 'murid'), [
            'title' => 'Dashboard',
            'user' => $user
        ]);
    }
}
