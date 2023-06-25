<?php

namespace App\Repositories;

use App\Interfaces\DaftarHadirInterface;
use App\Interfaces\GateInterface;
use App\Models\GateModel;
use App\Models\KetentuanModel;
use Carbon\Carbon;

class GateRepository implements GateInterface {
  
  private GateModel $gateModel;
  private KetentuanModel $ktModel;
  private DaftarHadirInterface $daftarHadirRepo;

  public function __construct(GateModel $gateModel, KetentuanModel $ktModel, DaftarHadirInterface $daftarHadirRepo)
  {
    $this->gateModel = $gateModel;
    $this->ktModel = $ktModel;
    $this->daftarHadirRepo = $daftarHadirRepo;
  }

  public function getAllGate()
  {
    try {
      $data = $this->gateModel->where('gate.status', 0)->joinList();
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

  public function getGateByRfid($section)
  {
    try {
      $gateData = $this->gateModel->where('section', $section)->first();
      if (!$gateData) {
        return array(
          'message' => 'gate not found',
          'code'    => 404
        );
      }
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

  public function checkGate($rfid)
  {
    try {
      $gateData = $this->gateModel->getSection($rfid)->first();
      if ($gateData) {
        $payloadList = array(
          'message' => 'mata pelajaran sedang berlangsung',
          'code'    => 404
        );
      } else {
        $payloadList = array(
          'message' => 'success',
          'code'    => 200
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
      $payload['tgl'    ] = $date->format('y-m-d');
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

      $gateData = $this->gateModel->getSection($rfid)->first();
      if (!$gateData) {
        return array(
          'message' => 'tidak ada matapelajaran yang dimulai',
          'code'    => 404
        );
      }

      $dafarHadir = $this->daftarHadirRepo->forceEndStudy($gateData['id']);
      if ($dafarHadir['code'] != 200) {
        return $dafarHadir;
      }
      
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

  public function closeAllGate()
  {
    try {
      $date = Carbon::now();
      $updateGate = array(
        'status' => 2,
        'close'  => $date->format('H:i:s')
      );

      $study  = $this->daftarHadirRepo->forceEndAllStudy($date->format('y-m-d'));

      if ($study['code'] != 200) {
        return $study;
      }
      
      $update = $this->gateModel->where('status', 0)->where('tgl', $date->format('Y-m-d'))->update($updateGate);

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

  public function forceClose($rfid)
  {
    try {
      $date = Carbon::now();
      $updateGate = array(
        'status' => 1,
        'close'  => $date->format('H:i:s')
      );
      $gateData = $this->gateModel->getSection($rfid);

      if ($gateData->first()) {
        $dafarHadir = $this->daftarHadirRepo->forceEndStudy($gateData->first()['id']);
        if ($dafarHadir['code'] != 200) {
          return $dafarHadir;
        }

        $payloadList = array(
          'message' => 'matapelajaran ini secara paksa diakhiri',
          'code'    => 200,
          'data'    => $gateData->update($updateGate)
        );
      } else {
        $payloadList = array(
          'message' => 'tidak ada matapelajaran yang berlangsung',
          'code'    => 200,
          'data'    => $gateData->update($updateGate)
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
}