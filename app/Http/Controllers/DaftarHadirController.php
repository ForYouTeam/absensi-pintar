<?php

namespace App\Http\Controllers;

use App\Interfaces\DaftarHadirInterface;
use Illuminate\Http\Request;

class DaftarHadirController extends Controller
{
    private DaftarHadirInterface $daftarHadirRepo;

    public function __construct(DaftarHadirInterface $daftarHadirRepo)
    {
        $this->daftarHadirRepo = $daftarHadirRepo;
    }

    public function getView() 
    {
        return view('pages.Daftar_hadir');
    }

    public function getAllPresent()
    {
        $data = $this->daftarHadirRepo->getAllPresentData();
        return response()->json($data, $data['code']);
    }

    public function getDataByQty()
    {
        $payload = array(
            'gate_id'  => request('gate_id' ),
            'kelas_id' => request('kelas_id')
        );

        $data = $this->daftarHadirRepo->getPayloadByQty($payload);
        return response()->json($data, $data['code']);
    }

    public function presentStart(Request $request)
    {
        $payload = array(
            "rfid"     => $request['rfid'     ],
            "gate_id"  => $request['gate_id'  ],
            "kelas_id" => $request['kelas_id' ]
        );

        $presentData = $this->daftarHadirRepo->setPresentStudent($payload);
        return response()->json($presentData, $presentData['code']);
    }
}
