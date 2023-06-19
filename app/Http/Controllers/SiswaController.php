<?php

namespace App\Http\Controllers;

use App\Interfaces\SiswaInterface;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    private SiswaInterface $siswaRepo;

	public function __construct(SiswaInterface $siswaRepo)
	{
		$this->siswaRepo = $siswaRepo;
	}

	public function getPayloadData()
	{
		$payload = $this->siswaRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->siswaRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(Request $request)
	{
		$id = $request->id | null;
		$payload = $this->siswaRepo->upsertPayload($id, $request->all());

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->siswaRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
