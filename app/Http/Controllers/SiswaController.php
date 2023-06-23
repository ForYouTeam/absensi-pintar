<?php

namespace App\Http\Controllers;

use App\Interfaces\JurusanInterface;
use App\Interfaces\KelasInterface;
use App\Interfaces\SiswaInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
		$fileUpload = $request->file('foto');
		$nameFile = 'photo' . $request->nisn . '.' . $fileUpload->getClientOriginalExtension();

		$data = $request->except('_token');
		$data['foto'] = $nameFile;

		$id = $request->id | null;
		$payload = $this->siswaRepo->upsertPayload($id, $data);

		if ($payload) {

			$filePath = public_path('storage/siswa/');
			$fileUpload->move($filePath, $nameFile);
		}

		return response()->json($payload, $payload['code']);
	}


	public function deletePayloadData($id)
	{
		$data = $this->siswaRepo->getPayloadById($id);
		$payload = $this->siswaRepo->deletePayload($id);
		$foto = $data['data']['foto'];

		File::delete(public_path('storage/siswa/' . $foto));

		return response()->json($payload, $payload['code']);
	}
}
