<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KRS;

class KRSController extends Controller
{
    public function index()
    {
        $listTahun = KRS::distinct()->pluck('Tahun');
        $listFakultas = KRS::distinct()->pluck('Fakultas');
        $dataUIGM = [];
        $dataFakultas = [];

        foreach ($listTahun as $tahun) {
            $data = KRS::select('Tahun', DB::raw('COUNT(DISTINCT NPM) AS JmlAll'), DB::raw('COUNT(DISTINCT CASE WHEN Fakultas="Ekonomi" THEN NPM END) AS FE'), DB::raw('COUNT(DISTINCT CASE WHEN Fakultas="Teknik" THEN NPM END) AS FT'), DB::raw('COUNT(DISTINCT CASE WHEN Fakultas="FKIP" THEN NPM END) AS FKIP'), DB::raw('COUNT(DISTINCT CASE WHEN Fakultas="FIPB" THEN NPM END) AS FIPB'), DB::raw('COUNT(DISTINCT CASE WHEN Fakultas="ILKOM SAINS" THEN NPM END) AS FIlkom'))->where('Tahun', $tahun)->groupBy('Tahun')->get();

            $dataUIGM[$tahun] = $data;
        }

        $listFakultas = ['Ekonomi', 'ILKOM SAINS', 'FKIP', 'Teknik', 'FIPB'];

        $dataFakultas = [];

        foreach ($listFakultas as $fakultas) {
            $queryFakultas = DB::table('tbl_master_krs')
                ->selectRaw(
                    '
            CASE
                WHEN Tahun = "20191" THEN "Data 2019"
                WHEN Tahun = "20201" THEN "Data 2020"
                WHEN Tahun = "20211" THEN "Data 2021"
                WHEN Tahun = "20221" THEN "Data 2022"
            END AS TahunData,
            COUNT(DISTINCT NPM) AS JumlahMahasiswa
        ',
                )
                ->where(function ($query) use ($fakultas) {
                    $query->where('Tahun', '20191')->whereRaw('LEFT(NPM, 4) = "2019"')->where('Fakultas', $fakultas);
                })
                ->orWhere(function ($query) use ($fakultas) {
                    $query->where('Tahun', '20201')->whereRaw('LEFT(NPM, 4) = "2020"')->where('Fakultas', $fakultas);
                })
                ->orWhere(function ($query) use ($fakultas) {
                    $query->where('Tahun', '20211')->whereRaw('LEFT(NPM, 4) = "2021"')->where('Fakultas', $fakultas);
                })
                ->orWhere(function ($query) use ($fakultas) {
                    $query->where('Tahun', '20221')->whereRaw('LEFT(NPM, 4) = "2022"')->where('Fakultas', $fakultas);
                })
                ->groupBy('TahunData')
                ->get();

            $dataFakultas[$fakultas] = $queryFakultas;
        }

        return view('krs', compact('listTahun', 'dataUIGM', 'queryFakultas', 'dataFakultas'));
    }
}
