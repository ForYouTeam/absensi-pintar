<?php

namespace App\Interfaces;

interface DaftarHadirInterface {
  public function upsertPayload($id, array $payload);
  public function getPayloadByQty(array $payload);
  public function getPresentStudent(array $payload);
  public function setPresentStudent($rfid);
  public function forceEndStudy($gateId);
  public function forceEndAllStudy($tgl);
  public function getAllPresentData();
}