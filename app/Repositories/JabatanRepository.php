<?php

namespace App\Repositories;

use App\Interfaces\JabatanInterface;
use App\Models\JabatanModel;
use Carbon\Carbon;

class JabatanRepository implements JabatanInterface {
  
  private JabatanModel $jabatanModel;

  public function __construct(JabatanModel $jabatanModel)
  {
    $this->jabatanModel = $jabatanModel;
  }

  public function getAllPayload()
  {
    try {
      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $this->jabatanModel->all()
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
      $data = $this->jabatanModel->whereId($id)->first();

      if ($data) {
        $payloadList = array(
          'message' => 'success',
          'code'    => 200,
          'data'    => $this->jabatanModel->whereId($id)->first()
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
            'data'    => $this->jabatanModel->whereId($id)->update($payload)
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
          'data'    => $this->jabatanModel->create($payload)
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
          'data'    => $this->jabatanModel->whereId($id)->delete()
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