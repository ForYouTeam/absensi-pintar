<?php

namespace App\Repositories;

use App\Http\Requests\AkunRequest;
use App\Interfaces\AkunInterface;
use App\Models\GuruModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AkunRepository implements AkunInterface
{

  private User $akunModel;
  private GuruModel $guruModel;

  public function __construct(User $akunModel, GuruModel $guruModel)
  {
    $this->akunModel = $akunModel;
    $this->guruModel = $guruModel;
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
  { {
      try {
        $date = Carbon::now();
        $hash = Hash::make($payload['password']);
        if ($id) {
          $status = $this->getPayloadById($id);

          if ($status['code'] == 200) {
            $newPayload = array(
              'username'   => $payload['username'],
              'password'   => $hash,
              'updated_at' => $date
            );

            $payloadList = array(
              'message' => 'success',
              'code'    => 200,
              'data'    => $this->akunModel->whereId($id)->update($newPayload)
            );
          } else {
            return $status;
          }
        } else {
          $newPayload = array(
            'username'   => $payload['username'],
            'password'   => $hash,
            'scope'      => $payload['scope'],
            'created_at' => $date,
            'updated_at' => $date
          );

          $payloadList = array(
            'message' => 'success',
            'code'    => 200,
            'data'    => $this->akunModel->create($newPayload)
          );
          $payloadList['data']->assignRole($payload['scope']);

          if ($payload['scope'] == 'guru') {
            $this->guruModel->whereId($payload['guru_id'])->update([
              "account" => $payloadList['data']['id'],
              "created_at" => $date
            ]);
          }
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
      $acount = $this->guruModel->where('account');
      $data = $this->getPayloadById($id);
      if ($data['code'] == 200) {
        $payloadList = array(
          'message' => 'success',
          'code'    => 200,
          'data'    => $this->akunModel->whereId($id)->delete($acount)
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
