<?php

namespace App\Http\Controllers;

use App\Http\Requests\AkunRequest;
use App\Interfaces\AkunInterface;
use Illuminate\Http\Request;

class AkunController extends Controller
{
	private AkunInterface $akunRepo;

	public function __construct(AkunInterface $akunRepo)
	{
		$this->akunRepo = $akunRepo;
	}

	public function getView()
	{
		
		$data = $this->akunRepo->getAllPayload();
		return view('Auth.Akun')->with('data', $data['data']);
	}

	public function getPayloadData()
	{
		$payload = $this->akunRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->akunRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(AkunRequest $request)
	{
		$id = $request->id | null;
		$payload = $this->akunRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->akunRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
