<?php

namespace App\Http\Controllers;

use App\Interfaces\JabatanInterface;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    private JabatanInterface $jabatanRepo;

	public function __construct(JabatanInterface $jabatanRepo)
	{
		$this->jabatanRepo = $jabatanRepo;
	}

	public function getPayloadData()
	{
		$payload = $this->jabatanRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->jabatanRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(Request $request)
	{
		$id = $request->id | null;
		$payload = $this->jabatanRepo->upsertPayload($id, $request->all());

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->jabatanRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
