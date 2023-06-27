<?php

namespace App\Repositories;

use App\Interfaces\DaftarHadirInterface;
use App\Interfaces\LogInterface;
use App\Interfaces\SiswaInterface;
use App\Models\DaftarHadirModel;
use Carbon\Carbon;

class DaftarHadirRepository implements DaftarHadirInterface
{

  private DaftarHadirModel $daftarHadirModel;
  private SiswaInterface   $siswaRepo;
  private LogInterface   $logRepo;

  public function __construct(DaftarHadirModel $daftarHadirModel, SiswaInterface $siswaRepo, LogInterface $logRepo)
  {
    $this->daftarHadirModel = $daftarHadirModel;
    $this->siswaRepo        = $siswaRepo;
    $this->logRepo          = $logRepo;
  }

  public function getAllPresentData()
  {
    try {
      $present = $this->daftarHadirModel->with('siswa.kelas', 'siswa.jurusan', 'gate')->get();
      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $present
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'from'    => 'getPayloadByQty',
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function upsertPayload($id, array $payload)
  {
    try {
      $date = Carbon::now();
      $payload['updated_at'] = $date;

      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $this->daftarHadirModel->whereId($id)->update($payload)
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;

  }

  public function getPayloadByQty($payload)
  {
    try {
      $data = $this->daftarHadirModel
        ->where('daftar_hadir.gate_id', $payload['gate_id'])
        ->joinList()
        ->orderBy('daftar_hadir.updated_at', 'desc');

      $payloadList = array(
        'message'     => 'berhasil mengambil data daftar hadir',
        'code'        => 200,
        'data'        => $data->take(5)->get(),
        'total_hadir' => $data->get()->count(),
        'total_siswa' =>  $this->siswaRepo->getByKelas($payload['kelas_id'])['total']
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'from'    => 'getPayloadByQty',
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function getPresentStudent($payload)
  {
    try {
      $date  = Carbon::now();
      $siswa = $this->siswaRepo->findByRfid($payload['rfid']);

      if ($siswa['code'] !== 200) {
        return $siswa;
      }

      $params = array(
        'gate_id'  => $payload['gate_id'],
        'siswa_id' => $siswa['data']['id'],
        'tgl'      => $date->format('y-m-d')
      );
      $present = $this->daftarHadirModel->getByFilter($params)->first();

      if (!$present) {
        return array(
          'message' => 'belum ada siswa yang hadir',
          'code'    => 404
        );
      }

      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $present
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'from'    => 'getPresentStudent',
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

   // CHANGING DATA

   function getDataAsString($data)
   {
    $date = Carbon::now();
    $nama = $data['nama'];
    $rfid = $data['rfid'];

    $result = $nama . ' | ' . $rfid  . ' | ' . $date;

    return $result;
   }
 
   // 

  public function setPresentStudent($payload)
  {
    try {
      $date    = Carbon::now();
      $present = $this->getPresentStudent($payload);
      $siswa = $this->siswaRepo->findByRfid($payload['rfid']);

      if ($siswa['code'] != 200) {
        return $siswa;
      }

      if ($siswa['data']['kelas_id'] != $payload['kelas_id']) {
        return array(
          'message' => 'kelas siswa tidak sesuai',
          'code'    => 404
        );
      }

      if ($present['code'] != 200 && $present['code'] !== 404) {
        return $present;
      }

      if ($present['code'] == 404) {

        $payload['tgl'] = $date->format('y-m-d');
        $payload['start_tap'] = $date->format('H:i:s');
        $payload['status'] = 2;
        $payload['siswa_id'] = $siswa['data']['id'];
        $payload['created_at'] = $date;
        $payload['updated_at'] = $date;

        unset($payload['rfid']);
        unset($payload['kelas_id']);

        $this->daftarHadirModel->insert($payload);

        $payloadList = array(
          'message' => 'Siswa hadir',
          'code'    => 200,
          'data'    => $siswa['data']
        );
      } else if ($present['code'] != 404 && !$present['data']['end_tap']) {

        $start_tap_time = Carbon::createFromFormat('H:i:s', $present['data']['start_tap']);

        // Dapatkan waktu sekarang
        $current_time = Carbon::now();

        // Hitung selisih waktu antara $start_tap dan waktu sekarang dalam menit
        $diff_minutes = $start_tap_time->diffInMinutes($current_time);

        if ($diff_minutes >= 5) {

          $this->daftarHadirModel->whereId($present['data']['id'])->update(array(
            'status'     => 1,
            'end_tap'    => $date->format('H:i:s'),
            'updated_at' => $current_time
          ));

          return array(
            'message' => 'Siswa pulang',
            'code'    => 200,
            'data'    => $siswa['data']
          );
        }

        $payloadList = array(
          'message' => 'terlalu cepat pulang',
          'code'    => 200,
          'data'    => $siswa['data']
        );
      } else {
        $payloadList = array(
          'message' => 'siswa telah pulang',
          'code'    => 200,
          'data'    => $siswa['data']
        );
      }

      if ($payloadList['data']) {
        $logpayload = array(
          'message' => $payloadList['message'],
          'data'    => $this->getDataAsString($payloadList['data']),
          'code'    => $payloadList['code'   ],
        );
      } else {
        $logpayload = array(
          'message' => $payloadList['message'],
          'data'    => 'no action',
          'code'    => $payloadList['code'   ],
        );
      }
  
      $logs = $this->logRepo->SetLog($logpayload);
  
      if ($logs['code'] != 200) {
        return $logs;
      }

    } catch (\Throwable $th) {
      $payloadList = array(
        'from'    => 'setPresentStudent',
        'message' => $th->getMessage(),
        'code'    => 500,
        'from'    => 'setPresentStudent'
      );
    }

    return $payloadList;
  }

  public function forceEndStudy($gateId)
  {
    try {
      $date = Carbon::now();
      $data = $this->daftarHadirModel->where('gate_id', $gateId)->where('end_tap', null)->update(array(
        'end_tap'    => Carbon::now()->format('H:i:s'),
        'status'     => 1,
        'updated_at' => $date
      ));

      $payloadList = array(
        'message' => 'siswa telah pulang',
        'code'    => 200,
        'data'    => $data
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function forceEndAllStudy($tgl)
  {
    try {
      $date = Carbon::now();
      $data = $this->daftarHadirModel->where('tgl', $tgl)->where('end_tap', null)->update(array(
        'end_tap' => $date->format('H:i:s'),
        'status'  => 3
      ));

      $payloadList = array(
        'message' => 'semua siswa telah pulang',
        'code'    => 200,
        'data'    => $data
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }
}
