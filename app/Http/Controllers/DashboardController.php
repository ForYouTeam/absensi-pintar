<?php

namespace App\Http\Controllers;

use App\Interfaces\DaftarHadirInterface;
use App\Models\DaftarHadirModel;
use App\Models\GuruModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\SiswaModel;

class DashboardController extends Controller
{

    private DaftarHadirInterface $daftarRepo;

    public function __construct(DaftarHadirInterface $daftarRepo)
    {
        $this->daftarRepo = $daftarRepo;
    }

    public function index()
    {
        $data = [
            'guru' => GuruModel::count(),
            'siswa' => SiswaModel::count(),
            'kelas' => KelasModel::count(),
            'jurusan' => JurusanModel::count(),
            // 'absen' => DaftarHadirModel::all()
        ];

        $datas = (new DaftarHadirModel())->joinList();
        return view('pages.Dashboard')->with(['data' => $data, 'datas' => $datas]);
    }

    // public function getPayloadData()
	// {
	// 	$payload = $this->daftarRepo->getAllPayload();
	// 	return response()->json($payload, $payload['code']);
	// }
}
