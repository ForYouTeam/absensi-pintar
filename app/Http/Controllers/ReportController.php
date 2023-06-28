<?php

namespace App\Http\Controllers;

use App\Models\DaftarHadirModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private DaftarHadirModel $daftarHadirModel;
    private SiswaModel $siswaModel;

    public function __construct(DaftarHadirModel $daftarHadirModel, SiswaModel $siswaModel)
    {
        $this->daftarHadirModel = $daftarHadirModel;
        $this->siswaModel = $siswaModel;
    }

    public function getView()
    {
        return view('pages.Report');
    }

    public function getAllDaftarHadir($payload)
    {
        $payload = array(
            "start"    => request('start'   ),
            "end"      => request('end'     ),
            "kelas_id" => request('kelas_id'),
        );

        $daftarHadir = $this->daftarHadirModel
            ->where('kelas_id', $payload['kelas_id'])
            ->whereBetween('tgl', ['2023-01-01', '2023-03-30'])
            ->joinList()
            ->get();
        return $daftarHadir;
    }

    public function getAllSiswaByKelas()
    {
        $hadir = $this->getAllDaftarHadir(request('kelas_id'));
        $allSiswa = $this->siswaModel->where('kelas_id', request('kelas_id'))->joinList()->get();

        return response()->json([
            "siswa" => $allSiswa,
            "daftar_hadir" => $hadir,
        ], 200);
    }
}
