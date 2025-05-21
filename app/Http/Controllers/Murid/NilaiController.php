<?php

namespace App\Http\Controllers\Murid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $murid = Auth::guard('murid')->user();
        $semesterList = ['1', '2'];
        $selectedSemester = $request->input('semester', '1'); // Ambil semester dari request atau default ke '1'

        $nilaiList = $murid->murid->nilai()
            ->with(['mapel', 'guru'])
            ->where('semester', $selectedSemester)
            ->latest()
            ->get();

        return view('murid.nilai.nilai', compact('nilaiList', 'semesterList', 'selectedSemester'), [
            'title' => 'Nilai Murid',
            'murid' => $murid->murid,
        ]); 
    }

     /**
     * Generate PDF laporan nilai murid
     *
     * @param int $murid_id
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request)
    {
        $murid = Auth::guard('murid')->user();
        $semester = $request->input('semester', '1');
        $nilaiList = $murid->murid->nilai()
            ->with(['mapel', 'guru'])
            ->where('semester', $semester)
            ->latest()
            ->get();
        
        $pdf = PDF::loadView('murid.nilai.nilai-pdf', [
            'murid' => $murid->murid,
            'nilaiList' => $nilaiList,
            'semester' => $semester
        ]);

        $pdf->getDomPDF()->getOptions()->setChroot(public_path());
        $pdf->getDomPDF()->getOptions()->set('isPhpEnabled', true);
        
        // Set paper size (optional)
        $pdf->setPaper('a4', 'portrait');
        
        // Download PDF file dengan nama custom
        return $pdf->download('Laporan_Nilai_'.$murid->murid->nama.'_'.date('YmdHis').'.pdf');
    }
}
