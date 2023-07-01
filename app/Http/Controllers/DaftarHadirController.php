<?php

namespace App\Http\Controllers;

use App\Interfaces\DaftarHadirInterface;
use App\Interfaces\GuruInterface;
use App\Models\GuruModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarHadirController extends Controller
{
    private DaftarHadirInterface $daftarHadirRepo;
    private GuruModel $guruModel;

    public function __construct(DaftarHadirInterface $daftarHadirRepo, GuruModel $guruModel)
    {
        $this->daftarHadirRepo = $daftarHadirRepo;
        $this->guruModel       = $guruModel;
    }

    public function getView()
    {
        if (Auth::user()->scope == "guru") {
            $guru = $this->guruModel->where('account', Auth::user()->id)->first();
            $guruId = $guru['id'];

            $payload = array(
                'guru_id'  => $guruId,
                'kelas_id' => request('kelas_id')
            );

            $data = $this->daftarHadirRepo->getAllByParams($payload);

            return view('pages.Daftar_hadir')->with('data', $data['data']);
        } else {
            $data = $this->daftarHadirRepo->getAllPresentData();
            if ($data['code'] !== 200) {
                return response()->json($data, $data['code']);
            }
            return view('pages.Daftar_hadir')->with('data', $data['data']);
        }
    }

    public function updatePayload(Request $request)
    {
        $id = $request->id;
        $payload = array(
            'status' => $request->status
        );
        $data = $this->daftarHadirRepo->upsertPayload($id, $payload);
        return response()->json($data, $data['code']);
    }

    public function getAllPresent()
    {
        $data = $this->daftarHadirRepo->getAllPresentData();
        return response()->json($data, $data['code']);
    }

    public function getWithParams()
    {
        if (request('accountid') != "null") {
            $guru = $this->guruModel->where('account', request('accountid'))->first();
            $guruId = $guru['id'];
        } else {
            $guruId = request('guru_id');
        }

        $payload = array(
            'guru_id'  => $guruId,
            'kelas_id' => request('kelas_id')
        );

        $data = $this->daftarHadirRepo->getAllByParams($payload);
        return response()->json($data, $data['code']);
    }

    public function getDataByQty()
    {
        $payload = array(
            'gate_id'  => request('gate_id'),
            'kelas_id' => request('kelas_id')
        );

        $data = $this->daftarHadirRepo->getPayloadByQty($payload);
        return response()->json($data, $data['code']);
    }

    public function presentStart(Request $request)
    {
        $payload = array(
            "rfid"     => $request['rfid'],
            "gate_id"  => $request['gate_id'],
            "kelas_id" => $request['kelas_id']
        );

        $presentData = $this->daftarHadirRepo->setPresentStudent($payload);
        return response()->json($presentData, $presentData['code']);
    }
}
