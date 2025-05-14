<?php

namespace App\Http\Controllers\Murid;
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
        $murid = Auth::guard('murid')->user();
        return view('murid.dashboard', [
            'title' => 'Dashboard',
            'murid' => $murid->murid
        ]); 
    }
}
