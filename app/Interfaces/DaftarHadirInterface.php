<?php

namespace App\Interfaces;

interface DaftarHadirInterface {
  public function getPresentStudent(array $payload);
  public function setPresentStudent($rfid);
  public function forceEndStudy($gateId);
  public function forceEndAllStudy($tgl);
}