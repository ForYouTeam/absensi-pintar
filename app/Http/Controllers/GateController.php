<?php

namespace App\Http\Controllers;

use App\Interfaces\GateInterface;
use App\Interfaces\GuruInterface;
use Illuminate\Http\Request;

class GateController extends Controller
{
    private GuruInterface $guruRepo;
    private GateInterface $gateRepo;
    public function __construct(GateInterface $gateRepo, GuruInterface $guruRepo)
    {
        $this->guruRepo = $guruRepo;
        $this->gateRepo = $gateRepo;
    }

    public function openGate(Request $request)
    {
        $check = $this->guruRepo->getByRfid($request['rfid']);
        if ($check['code'] !== 200) {
            return response()->json($check, $check['code']);
        }

        $gateData = array(
            'rfid'     => $request['rfid'],
            'kelas_id' => $request['kelas_id'],
            'guru_id'  => $request['guru_id' ],
            'mapel'    => $request['mapel'   ],
        );

        $openGate = $this->gateRepo->openGateScanner($gateData);
        return response()->json($openGate, $openGate['code']);
    }

    public function closeGate($rfid)
    {
        $openGate = $this->gateRepo->closeGateScanner($rfid);
        return response()->json($openGate, $openGate['code']);
    }
}
