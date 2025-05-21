<?php

namespace App\Http\Controllers\Murid;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $murid = Auth::guard('murid')->user();
        $muridModel = $murid->murid;

        // Mengambil semua nilai murid dan mengelompokkannya berdasarkan predikat
        $nilaiPredikat = Nilai::where('murid_id', $muridModel->id)
            ->select('predikat', DB::raw('count(*) as jumlah'))
            ->groupBy('predikat')
            ->orderBy('predikat')
            ->get();
        
        // Menyiapkan array labels dan data untuk chart
        $predicates = [];
        $counts = [];
        
        foreach ($nilaiPredikat as $nilai) {
            $predicates[] = $nilai->predikat;
            $counts[] = $nilai->jumlah;
        }

        return view('murid.dashboard', [
            'title' => 'Dashboard',
            'murid' => $muridModel,
            'predicates' => $predicates,
            'counts' => $counts
        ]); 
    }
}
