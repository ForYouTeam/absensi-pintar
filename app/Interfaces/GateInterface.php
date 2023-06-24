<?php

namespace App\Interfaces;

interface GateInterface {
  public function openGateScanner(array $payload);
  public function closeGateScanner($rfid);
}