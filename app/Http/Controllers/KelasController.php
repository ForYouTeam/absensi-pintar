<?php

namespace App\Http\Controllers;

use App\Interfaces\JurusanInterface;
use App\Interfaces\KelasInterface;
use App\Models\JurusanModel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
	private KelasInterface $kelasRepo;
	private JurusanInterface $jurusanRepo;

	public function __construct(KelasInterface $kelasRepo, JurusanInterface $jurusanRepo)
	{
		$this->kelasRepo = $kelasRepo;
		$this->jurusanRepo = $jurusanRepo;
	}

	public function getView()
	{
		$dataJurusan = $this->jurusanRepo->getAllPayload();
		$data = $this->kelasRepo->getAllPayload();
		return view('pages.Kelas')->with(['data' => $data['data'], 'dataJurusan' => $dataJurusan['data']]);
	}

	public function getPayloadData()
	{
		$payload = $this->kelasRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->kelasRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(Request $request)
	{
		$id = $request->id | null;
		$payload = $this->kelasRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->kelasRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
