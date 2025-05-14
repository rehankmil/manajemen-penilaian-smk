<?php

namespace App\Http\Controllers\Guru;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        return view('guru.dashboard', [
            'title' => 'Dashboard',
            'guru' => $guru->guru
        ]);
    }
}
