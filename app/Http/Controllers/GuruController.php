<?php

namespace App\Http\Controllers;

use App\Interfaces\GuruInterface;
use App\Interfaces\JabatanInterface;
use App\Interfaces\MapelInterface;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    private GuruInterface $guruRepo;
	private JabatanInterface $jabatanRepo;
	private MapelInterface $mapelRepo;

	public function __construct(GuruInterface $guruRepo, JabatanInterface $jabatanRepo, MapelInterface $mapelRepo)
	{
		$this->guruRepo = $guruRepo;
		$this->jabatanRepo = $jabatanRepo;
		$this->mapelRepo = $mapelRepo;
	}

	public function getView() 
	{
		$guru = $this->guruRepo->getAllPayload();
		$mapel = $this->mapelRepo->getAllPayload();
		$jabatan = $this->jabatanRepo->getAllPayload();

		return view('Data.Guru')->with([
			'guru' => $guru['data'],
			'mapel' => $mapel['data'],
			'jabatan' => $jabatan['data']
		]);
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
		$payload = $this->guruRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->guruRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
