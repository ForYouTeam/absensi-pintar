<?php

namespace App\Repositories;

use App\Interfaces\JurusanInterface;
use App\Models\JurusanModel;
use Carbon\Carbon;

class JurusanRepository implements JurusanInterface {
  
  private JurusanModel $jurusanModel;

  public function __construct(JurusanModel $jurusanModel)
  {
    $this->jurusanModel = $jurusanModel;
  }

  public function getAllPayload()
  {
    try {
      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $this->jurusanModel->all()
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
      $data = $this->jurusanModel->whereId($id)->first();

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
            'data'    => $this->jurusanModel->whereId($id)->update($payload)
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
          'data'    => $this->jurusanModel->create($payload)
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
          'data'    => $this->jurusanModel->whereId($id)->delete()
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