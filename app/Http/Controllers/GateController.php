<?php

namespace App\Http\Controllers;

use App\Http\Requests\GateRequest;
use App\Interfaces\GateInterface;
use App\Interfaces\GuruInterface;
use App\Interfaces\KelasInterface;
use App\Interfaces\MapelInterface;
use Illuminate\Http\Request;

class GateController extends Controller
{
    private GuruInterface $guruRepo;
    private GateInterface $gateRepo;
    private MapelInterface $mapelRepo;
    private KelasInterface $kelasRepo;

    public function __construct(GateInterface $gateRepo, GuruInterface $guruRepo, MapelInterface $mapelRepo, KelasInterface $kelasRepo)
    {
        $this->guruRepo = $guruRepo;
        $this->gateRepo = $gateRepo;
        $this->mapelRepo = $mapelRepo;
        $this->kelasRepo = $kelasRepo;
    }

    public function getView()
    {

        $data = [
            'gate' => $this->gateRepo->getAllPayload()['data'],
            'mapel' => $this->mapelRepo->getAllPayload()['data'],
            'kelas' => $this->kelasRepo->getAllPayload()['data'],
        ];
        return view('pages.Gate')->with('data', $data);
    }

    public function getPayloadData()
    {
        $payload = $this->gateRepo->getAllPayload();
        return response()->json($payload, $payload['code']);
    }

    public function openGate(GateRequest $request)
    {
        $checkGuru = $this->guruRepo->getByRfid($request['rfid']);
        if ($checkGuru['code'] !== 200) {
            return response()->json($checkGuru, $checkGuru['code']);
        }

        $checkGate = $this->gateRepo->checkGate($request['rfid']);
        if ($checkGate['code'] !== 200) {
            return response()->json($checkGate, $checkGate['code']);
        }

        $gateData = array(
            'rfid'     => $request['rfid'],
            'kelas_id' => $request['kelas_id'],
            'guru_id'  => $checkGuru['data']['id'],
            'mapel'    => $request['mapel'],
        );

        $openGate = $this->gateRepo->openGateScanner($gateData);
        return response()->json($openGate, $openGate['code']);
    }

    public function closeGate($rfid)
    {
        $openGate = $this->gateRepo->closeGateScanner($rfid);
        return response()->json($openGate, $openGate['code']);
    }

    public function forceCloseGate($rfid)
    {
        $gateData = $this->gateRepo->forceClose($rfid);
        return response()->json($gateData, $gateData['code']);
    }

    public function forceCloseAllGate()
    {
        $gateData = $this->gateRepo->closeAllGate();
        return response()->json($gateData, $gateData['code']);
    }

    public function getAllData()
    {
        $gateData = $this->gateRepo->getAllGate();
        return response()->json($gateData, $gateData['code']);
    }
}
