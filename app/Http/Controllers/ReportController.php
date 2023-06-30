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
        $daftarHadir = $this->daftarHadirModel
            ->getByKelasGuru($payload)
            ->get();
        return $daftarHadir;
    }

    public function getAllSiswaByKelas()
    {
        $payload = array(
            "start"    => request('start'    ),
            "end"      => request('end'      ),
            "kelas_id" => request('kelas_id' ),
            "guru_id"  => request('guru_id'  ),
        );

        $hadir = $this->getAllDaftarHadir($payload);
        $allSiswa = $this->siswaModel->where('kelas_id', request('kelas_id'))->joinList()->get();

        return response()->json([
            "payload"      => $payload ,
            "siswa"        => $allSiswa,
            "daftar_hadir" => $hadir   ,
        ], 200);
    }
}
