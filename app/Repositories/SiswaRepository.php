<?php

namespace App\Repositories;

use App\Interfaces\SiswaInterface;
use App\Models\SiswaModel;
use Carbon\Carbon;

class SiswaRepository implements SiswaInterface {
  
  private SiswaModel $siswaModel;

  public function __construct(SiswaModel $siswaModel)
  {
    $this->siswaModel = $siswaModel;
  }
  
  public function findByRfid($rfid)
  {
    try {
      $payloadList = $this->siswaModel->where('rfid', $rfid)->joinList()->first();

      if (!$payloadList) {
        return array(
          'message' => 'siswa tidak ditemukan',
          'code'    => 404,
        );
      }
      
      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $payloadList
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'from'    => 'findByRfid',
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function getByKelas($kelas)
  {
    try {
      $data = $this->siswaModel->where('siswa.kelas_id', 'LIKE', '%'.$kelas.'%')->joinList()->get();
      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $data,
        'total'   => $data->count()
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function getAllPayload()
  {
    try {
      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $this->siswaModel->joinList()->get()
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function getPayloadById($id)
  {
    try {
      $data = $this->siswaModel->where('siswa.id', $id)->joinList()->first();

      if ($data) {
        $payloadList = array(
          'message' => 'success',
          'code'    => 200,
          'data'    => $data
        );
      } else {
        $payloadList = array(
          'message' => 'not found',
          'code'    => 404,
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

  public function upsertPayload($id, array $payload)
  {
    try {
      $date = Carbon::now();
      if ($id) {
        $status = $this->getPayloadById($id);
        
        if ($status['code'] == 200) {
          $payload['updated_at'] = $date;

          $payloadList = array(
            'message' => 'success',
            'code'    => 200,
            'data'    => $this->siswaModel->whereId($id)->update($payload)
          );
        } else {
          $payloadList = $status;
        }
        
      } else {
        $payload['created_at'] = $date;
        $payload['updated_at'] = $date;

        $payloadList = array(
          'message' => 'success',
          'code'    => 200,
          'data'    => $this->siswaModel->create($payload)
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

  public function deletePayload($id)
  {
    try {
      
      $data = $this->getPayloadById($id);
      if ($data['code'] == 200) {
        $payloadList = array(
          'message' => 'success',
          'code'    => 200,
          'data'    => $this->siswaModel->whereId($id)->delete()
        );
      } else {
        $payloadList = $data;
      }
      
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }
    
    return $payloadList;
  }

}