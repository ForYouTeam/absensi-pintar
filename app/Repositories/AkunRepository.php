<?php

namespace App\Repositories;

use App\Http\Requests\AkunRequest;
use App\Interfaces\AkunInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AkunRepository implements  AkunInterface {
  
  private User $akunModel;

  public function __construct(User $akunModel)
  {
    $this->akunModel = $akunModel;
  }

    public function getAllPayload()
    {
        try {
            $payloadList = array(
              'message' => 'success',
              'code'    => 200,
              'data'    => $this->akunModel->get()
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
            $data = $this->akunModel->whereId($id)->first();
      
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
      {
        try {
          $dataId = $this->getPayloadById($id);
          $encryptId = Uuid::uuid4()->toString();
          $date = Carbon::now();
          $hash = Hash::make($payload['password']);
          if ($id) {
            $status = $this->getPayloadById($id);
            
            if ($status['code'] == 200) {
              $payload['updated_at'] = $date;
              $payload['password'] = $hash;
    
              $payloadList = array(
                'message' => 'success',
                'code'    => 200,
                'data'    => $this->akunModel->whereId($id)->update($payload)
              );
            } else {
              $payloadList = $status;
            }
            
          } else {
            $payload['created_at'] = $date;
            $payload['updated_at'] = $date;
            $payload['password'] = $hash;
            $dataId = crc32($encryptId);
    
            $payloadList = array(
              'message' => 'success',
              'code'    => 200,
              'data'    => $this->akunModel->create($payload, $dataId)
            );
            $payloadList['data']->assignRole($payload['scope']);
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

    public function deletePayload($id)
    {
        try {
        
        $data = $this->getPayloadById($id);
        if ($data['code'] == 200) {
            $payloadList = array(
            'message' => 'success',
            'code'    => 200,
            'data'    => $this->akunModel->whereId($id)->delete()
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