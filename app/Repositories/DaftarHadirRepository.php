<?php

namespace App\Repositories;

use App\Interfaces\DaftarHadirInterface;
use App\Interfaces\SiswaInterface;
use App\Models\DaftarHadirModel;
use Carbon\Carbon;

class DaftarHadirRepository implements DaftarHadirInterface {
  
  private DaftarHadirModel $daftarHadirModel;
  private SiswaInterface   $siswaRepo       ;

  public function __construct(DaftarHadirModel $daftarHadirModel, SiswaInterface $siswaRepo)
  {
    $this->daftarHadirModel = $daftarHadirModel;
    $this->siswaRepo        = $siswaRepo       ;
  }

  public function getPayloadByQty($gateId)
  {
    try {
      $data = $this->daftarHadirModel
      ->where('daftar_hadir.gate_id', $gateId)
      ->joinList()
      ->orderBy('daftar_hadir.updated_at', 'desc')
      ->take(5)
      ->get();

      $payloadList = array(
        'message' => 'berhasil mengambil data daftar hadir',
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
        'siswa_id' => $siswa  ['data']['id'],
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
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function setPresentStudent($payload)
  {
    try {
      $date    = Carbon::now();
      $present = $this->getPresentStudent($payload);
      $siswa = $this->siswaRepo->findByRfid($payload['rfid']);

      if ($siswa['data']['kelas_id'] != $payload['kelas_id']) {
        return array(
          'message' => 'kelas siswa tidak sesuai',
          'code'    => 404
        );
      }

      if ($siswa['code'] !== 200) {
        return $siswa;
      }
      
      if ($present['code'] !== 200 && $present['code'] !== 404 ) {
        return $present;
      }

      if ($present['code'] == 404) {

        $payload['tgl'        ] = $date->format('y-m-d');
        $payload['start_tap'  ] = $date->format('H:i:s');
        $payload['status'     ] = 2                     ;
        $payload['siswa_id'   ] = $siswa['data']['id']  ;
        $payload['created_at' ] = $date                 ;
        $payload['updated_at' ] = $date                 ;

        unset($payload['rfid']);
        unset($payload['kelas_id']);

        $this->daftarHadirModel->insert($payload);

        $payloadList = array(
          'message' => 'Siswa hadir',
          'code'    => 200,
          'data'    => $siswa
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
            'data'    => $siswa
          );
        }
        
        $payloadList = array(
          'message' => 'terlalu cepat pulang',
          'code'    => 200,
          'data'    => $siswa
        );

      } else {
        $payloadList = array(
          'message' => 'siswa telah pulang',
          'code'    => 200,
          'data'    => $siswa
        );
      }
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
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
        'status'  => 3,
        'updated' => $date
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