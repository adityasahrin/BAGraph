<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Nilai;

class NilaiController extends Controller
{
    public function index()
    {
        $fakultasDataGraph = [];
        $fakultasList = ['Ekonomi', 'ILKOM SAINS', 'Teknik', 'FIPB', 'FKIP'];

        foreach ($fakultasList as $fakultas) {
            $data = Nilai::select(
                'Tahun',
                DB::raw('SUM(CASE WHEN Huruf = "A" THEN 1 ELSE 0 END) AS A_count'),
                DB::raw('SUM(CASE WHEN Huruf = "B" THEN 1 ELSE 0 END) AS B_count'),
                DB::raw('SUM(CASE WHEN Huruf = "C" THEN 1 ELSE 0 END) AS C_count'),
                DB::raw('SUM(CASE WHEN Huruf = "D" THEN 1 ELSE 0 END) AS D_count'),
                DB::raw('SUM(CASE WHEN Huruf = "E" THEN 1 ELSE 0 END) AS E_count'),
                DB::raw('COUNT(*) AS total_count')
            )
                ->where('Fakultas', $fakultas)
                ->groupBy('Tahun')
                ->get();

            $fakultasDataGraph[$fakultas] = $data;
        }

        return view('nilai', [
            'title' => 'Nilai',
            'fakultasDataGraph' => $fakultasDataGraph,
            'fakultasList' => $fakultasList,
        ]);
    }

    public function getFakultasTable($fakultas)
    {
        $fakultasDataTable = [];
        $data = Nilai::select(
            'Tahun',
            DB::raw('SUM(CASE WHEN Huruf = "A" THEN 1 ELSE 0 END) AS A_count'),
            DB::raw('SUM(CASE WHEN Huruf = "B" THEN 1 ELSE 0 END) AS B_count'),
            DB::raw('SUM(CASE WHEN Huruf = "C" THEN 1 ELSE 0 END) AS C_count'),
            DB::raw('SUM(CASE WHEN Huruf = "D" THEN 1 ELSE 0 END) AS D_count'),
            DB::raw('SUM(CASE WHEN Huruf = "E" THEN 1 ELSE 0 END) AS E_count'),
            DB::raw('COUNT(*) AS total_count')
        )
            ->where('Fakultas', $fakultas)
            ->groupBy('Tahun')
            ->get();

        foreach ($data as $item) {
            $total = $item->A_count + $item->B_count + $item->C_count + $item->D_count + $item->E_count;
            $item->A_percentage = ($total != 0) ? ($item->A_count / $total) * 100 : 0;
            $item->B_percentage = ($total != 0) ? ($item->B_count / $total) * 100 : 0;
            $item->C_percentage = ($total != 0) ? ($item->C_count / $total) * 100 : 0;
            $item->D_percentage = ($total != 0) ? ($item->D_count / $total) * 100 : 0;
            $item->E_percentage = ($total != 0) ? ($item->E_count / $total) * 100 : 0;
        }
        $fakultasDataTable[$fakultas] = $data;

        return view('partials.fakultas_table', compact('data'));
    }
}
