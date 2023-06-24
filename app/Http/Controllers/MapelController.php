<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapelRequest;
use App\Interfaces\MapelInterface;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    private MapelInterface $mapelRepo;

	public function __construct(MapelInterface $mapelRepo)
	{
		$this->mapelRepo = $mapelRepo;
	}

	public function getView()
	{
		$data = $this->mapelRepo->getAllPayload();
		return view('pages.Mapel')->with('data', $data['data']);
	}

	public function getPayloadData()
	{
		$payload = $this->mapelRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->mapelRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(MapelRequest $request)
	{
		$id = $request->id | null;
		$payload = $this->mapelRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->mapelRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
