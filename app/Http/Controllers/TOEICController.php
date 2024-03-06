<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TOEIC;
use Illuminate\Support\Facades\DB;

class TOEICController extends Controller
{
    public function index()
    {
        $mkDataGraph = [];
        $mkList = ['English for International Communication I',
        'English for International Communication II',
        'English for International Communication III', 
        'English for International Communication IV'];

        foreach ($mkList as $mk) {
            $data = TOEIC::select('Tahun', DB::raw('SUM(CASE WHEN Huruf = "A" THEN 1 ELSE 0 END) AS A_count'), DB::raw('SUM(CASE WHEN Huruf = "B" THEN 1 ELSE 0 END) AS B_count'), DB::raw('SUM(CASE WHEN Huruf = "C" THEN 1 ELSE 0 END) AS C_count'), DB::raw('SUM(CASE WHEN Huruf = "D" THEN 1 ELSE 0 END) AS D_count'), DB::raw('SUM(CASE WHEN Huruf = "E" THEN 1 ELSE 0 END) AS E_count'), DB::raw('COUNT(*) AS total_count'))->where('Nama_MK', $mk)->groupBy('Tahun')->get();

            $mkDataGraph[$mk] = $data;
        }

        return view('toeic', [
            'mkDataGraph' => $mkDataGraph,
            'mkList' => $mkList,
        ]);
    }

    public function getEICTable($EIC)
    {
        $EICDataTable = [];
        $data = TOEIC::select('Tahun', DB::raw('SUM(CASE WHEN Huruf = "A" THEN 1 ELSE 0 END) AS A_count'), DB::raw('SUM(CASE WHEN Huruf = "B" THEN 1 ELSE 0 END) AS B_count'), DB::raw('SUM(CASE WHEN Huruf = "C" THEN 1 ELSE 0 END) AS C_count'), DB::raw('SUM(CASE WHEN Huruf = "D" THEN 1 ELSE 0 END) AS D_count'), DB::raw('SUM(CASE WHEN Huruf = "E" THEN 1 ELSE 0 END) AS E_count'), DB::raw('COUNT(*) AS total_count'))->where('Nama_MK', $EIC)->groupBy('Tahun')->get();

        foreach ($data as $item) {
            $total = $item->A_count + $item->B_count + $item->C_count + $item->D_count + $item->E_count;
            $item->A_percentage = $total != 0 ? ($item->A_count / $total) * 100 : 0;
            $item->B_percentage = $total != 0 ? ($item->B_count / $total) * 100 : 0;
            $item->C_percentage = $total != 0 ? ($item->C_count / $total) * 100 : 0;
            $item->D_percentage = $total != 0 ? ($item->D_count / $total) * 100 : 0;
            $item->E_percentage = $total != 0 ? ($item->E_count / $total) * 100 : 0;
        }
        $EICDataTable[$EIC] = $data;

        return view('partials.EIC_table', compact('data'));
    }
}
