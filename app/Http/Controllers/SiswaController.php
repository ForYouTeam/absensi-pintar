<?php

namespace App\Http\Controllers;

use App\Interfaces\JurusanInterface;
use App\Interfaces\KelasInterface;
use App\Interfaces\SiswaInterface;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
	private SiswaInterface $siswaRepo;
	private KelasInterface $kelasRepo;
	private JurusanInterface $jurusanRepo;

	public function __construct(SiswaInterface $siswaRepo, KelasInterface $kelasRepo, JurusanInterface $jurusanRepo)
	{
		$this->siswaRepo = $siswaRepo;
		$this->kelasRepo = $kelasRepo;
		$this->jurusanRepo = $jurusanRepo;
	}

	public function getView() 
	{
		$siswa = $this->siswaRepo->getAllPayload();
		$kelas = $this->kelasRepo->getAllPayload();
		$jurusan = $this->jurusanRepo->getAllPayload();

		return view('Data.Siswa')->with([
			'siswa' => $siswa['data'],
			'kelas' => $kelas['data'],
			'jurusan' => $jurusan['data']
		]);
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
		$payload = $this->siswaRepo->upsertPayload($id, $request->except('_token'));

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$payload = $this->siswaRepo->deletePayload($id);

		return response()->json($payload, $payload['code']);
	}
}
