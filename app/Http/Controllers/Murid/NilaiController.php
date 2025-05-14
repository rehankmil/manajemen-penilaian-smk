<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $murid = Auth::guard('murid')->user();
        return view('murid.nilai', [
            'title' => 'Nilai Murid',
            'murid' => $murid->murid,
            'nilaiList' => $murid->murid->nilai
        ]);  
    }
}
