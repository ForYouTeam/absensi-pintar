<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuruRequest;
use App\Interfaces\GuruInterface;
use App\Interfaces\JabatanInterface;
use App\Interfaces\MapelInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

		return view('pages.Guru')->with([
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

	public function upsertPayloadData(GuruRequest $request)
	{
		$fileUpload = $request->file('foto');
		$nameFile = 'photo' . $request->nip . '.' . $fileUpload->getClientOriginalExtension();

		$data = $request->except('_token');
		$data['foto'] = $nameFile;

		$id = $request->id | null;
		$payload = $this->guruRepo->upsertPayload($id, $data);

		if ($payload) {
			// return response()->json($request->file('foto')->getClientOriginalExtension());

			$filePath = public_path('storage/guru/');
			$fileUpload->move($filePath, $nameFile);
		}

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$data = $this->guruRepo->getPayloadById($id);
		$payload = $this->guruRepo->deletePayload($id);
		$foto = $data['data']['foto'];

		File::delete(public_path('storage/guru/' . $foto));

		return response()->json($payload, $payload['code']);
	}
}
