<?php

namespace App\Repositories;

use App\Interfaces\KelasInterface;
use App\Models\KelasModel;
use Carbon\Carbon;

class KelasRepository implements KelasInterface {
  
  private KelasModel $kelasModel;

  public function __construct(KelasModel $kelasModel)
  {
    $this->kelasModel = $kelasModel;
  }

  public function getAllPayload()
  {
    try {
      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $this->kelasModel->joinList()->get()
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
      $data = $this->kelasModel->where('kelas.id', $id)->joinList()->first();

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
            'data'    => $this->kelasModel->whereId($id)->update($payload)
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
          'data'    => $this->kelasModel->create($payload)
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
          'data'    => $this->kelasModel->whereId($id)->delete()
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