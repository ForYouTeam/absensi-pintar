<?php

namespace App\Repositories;

use App\Interfaces\GateInterface;
use App\Models\GateModel;
use App\Models\KetentuanModel;
use Carbon\Carbon;

class GateRepository implements GateInterface {
  
  private GateModel $gateModel;
  private KetentuanModel $ktModel;

  public function __construct(GateModel $gateModel, KetentuanModel $ktModel)
  {
    $this->gateModel = $gateModel;
    $this->ktModel = $ktModel;
  }

  public function openGateScanner(array $payload)
  {
    try {
      $date = Carbon::now();
      $time = $date->format('H:i:s');
      $existPayload = array(
        'tgl'     => $date,
        'timenow' => $time
      );
      $exist = $this->ktModel->getValidationTime($existPayload);

      if (!$exist) {
        $payloadList = array(
          'message' => 'tidak dapat mengaktifkan scanner sebelum ketentuan berlaku',
          'code'    => 404
        );

        return $payloadList;
      }

      $payload['section'] = $date->format('dmYHis') . "_" . $payload['rfid'];
      $payload['open'   ] = $time;
      $payload['tgl'    ] = $date;
      $payload['status' ] = 0;
      $gateData = $this->gateModel->create($payload);

      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $gateData
      );
    } catch (\Throwable $th) {
      $payloadList = array(
        'message' => $th->getMessage(),
        'code'    => 500
      );
    }

    return $payloadList;
  }

  public function closeGateScanner($rfid)
  {
    try {
      $date = Carbon::now();
      $time = $date->format('H:i:s');

      $gateData = $this->gateModel->getSection($rfid);
      
      $update = $this->gateModel->whereId($gateData['id'])->update(array(
        'status' => 1,
        "close"  => $time
      ));

      $payloadList = array(
        'message' => 'success',
        'code'    => 200,
        'data'    => $update
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