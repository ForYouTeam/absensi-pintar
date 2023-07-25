<?php

namespace App\Http\Controllers;

use App\Http\Requests\KetentuanRequest;
use App\Interfaces\KetentuanInterface;
use Illuminate\Http\Request;

class KetentuanController extends Controller
{
    private KetentuanInterface $ketentuanRepo;

	public function __construct(KetentuanInterface $ketentuanRepo)
	{
		$this->ketentuanRepo = $ketentuanRepo;
	}

	public function getView() 
	{
		$data = $this->ketentuanRepo->getAllPayload();
		return view('pages.Ketentuan')->with('data', $data['data']);
	}

	public function getPayloadData()
	{
		$payload = $this->ketentuanRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->ketentuanRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(KetentuanRequest $request)
	{
		$id = $request->id | null;
		$checKPayload = $this->ketentuanRepo->checkPayload($request->tipe);

		if ($checKPayload['code'] != 404) {
			return response()->json($checKPayload, $checKPayload['code']);
		}
		$payload = $this->ketentuanRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->ketentuanRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
