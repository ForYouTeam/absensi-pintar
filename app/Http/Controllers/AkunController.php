<?php

namespace App\Http\Controllers;

use App\Http\Requests\AkunRequest;
use App\Interfaces\AkunInterface;
use App\Interfaces\GuruInterface;
use Illuminate\Http\Request;

class AkunController extends Controller
{
	private AkunInterface $akunRepo;
	private GuruInterface $guruRepo;

	public function __construct(AkunInterface $akunRepo, GuruInterface $guruRepo)
	{
		$this->akunRepo = $akunRepo;
		$this->guruRepo = $guruRepo;
	}

	public function getView()
	{
		$data = [
			'akun' => $this->akunRepo->getAllPayload()['data'],
			'guru' => $this->guruRepo->getAllPayload()['data']
		];
		return view('Auth.Akun')->with('data', $data);
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
