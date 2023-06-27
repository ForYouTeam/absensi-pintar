<?php

namespace App\Repositories;

use App\Interfaces\LogInterface;
use App\Models\LogModel;
use Carbon\Carbon;

class LogRepository implements LogInterface {
  
  private LogModel $logModel;

  public function __construct(LogModel $logModel)
  {
    $this->logModel = $logModel;
  }

  public function SetLog(array $payload)
  {
    try {
      $date = Carbon::now();
      $payload['created_at'] = $date;
      $payload['updated_at'] = $date;

      $data = $this->logModel->create($payload);

      $payloadList = array(
        'message' => 'success',
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

  public function GetLog(array $meta)
  {
    try {
      $data = $this->logModel
      ->orderBy('created_at')
      ->limit(50)
      ->get();

      $payloadList = array(
        'message' => 'success',
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