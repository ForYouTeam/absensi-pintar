<?php

namespace App\Http\Controllers;

use App\Interfaces\GuruInterface;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    private GuruInterface $guruRepo;

	public function __construct(GuruInterface $guruRepo)
	{
		$this->guruRepo = $guruRepo;
	}

	public function getPayloadData()
	{
		$payload = $this->guruRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->guruRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(Request $request)
	{
		$id = $request->id | null;
		$payload = $this->guruRepo->upsertPayload($id, $request->all());

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->guruRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
