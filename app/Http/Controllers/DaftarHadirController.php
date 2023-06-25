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
        return view('pages.DaftarHadir');
    }

    public function getDataByQty($gateId)
    {
        $data = $this->daftarHadirRepo->getPayloadByQty($gateId);
        return response()->json($data, $data['code']);
    }

    public function presentStart(Request $request)
    {
        $payload = array(
            "rfid"    => $request['rfid'   ],
            "gate_id" => $request['gate_id']
        );

        $presentData = $this->daftarHadirRepo->setPresentStudent($payload);
        return response()->json($presentData, $presentData['code']);
    }
}
