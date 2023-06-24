<?php

namespace App\Http\Controllers;

use App\Interfaces\JurusanInterface;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
	private JurusanInterface $jurusanRepo;

	public function __construct(JurusanInterface $jurusanRepo)
	{
		$this->jurusanRepo = $jurusanRepo;
	}

	public function getView()
	{
		
		$data = $this->jurusanRepo->getAllPayload();
		return view('pages.Jurusan')->with('data', $data['data']);
	}

	public function getPayloadData()
	{
		$payload = $this->jurusanRepo->getAllPayload();
		return response()->json($payload, $payload['code']);
	}

	public function getPayloadDataId($id)
	{
		$payload = $this->jurusanRepo->getPayloadById($id);

		return response()->json($payload, $payload['code']);
	}

	public function upsertPayloadData(Request $request)
	{
		$id = $request->id | null;
		$payload = $this->jurusanRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->jurusanRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
