<?php
namespace App\Http\Controllers;

use App\Models\Riwayat;
use Barryvdh\DomPDF\Facade as PDF;


class RiwayatController extends Controller
{
 

    public function orderReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $riwayat = Riwayat::with(['laporan.view'])->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('laporan.cetek_laporan', compact('laporan', 'date'));
        return $pdf->stream();
    }

    public function index()
    {
        $riwayat = Riwayat::all();
        return view('laporan.view', compact('riwayat'));
    }

    public function exportPdf()
    {
        $riwayat = Riwayat::all();
        $pdf = Pdf::loadView('laporan.view', compact('riwayat'));
        return $pdf->download('laporan.cetak_laporan');
    }
}
