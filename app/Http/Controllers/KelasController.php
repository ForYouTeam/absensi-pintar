<?php

namespace App\Http\Controllers;

use App\Interfaces\KelasInterface;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private KelasInterface $kelasRepo;

	public function __construct(KelasInterface $kelasRepo)
	{
		$this->kelasRepo = $kelasRepo;
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
		$payload = $this->kelasRepo->upsertPayload($id, $request->all());

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->kelasRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
