<?php

namespace App\Interfaces;

interface GateInterface {
  public function getAllPayload();
  public function checkGate($rfid);
  public function openGateScanner(array $payload);
  public function closeGateScanner($rfid);
  public function closeAllGate();
  public function forceClose($rfid);
  public function getAllGate();
  public function getGateByRfid($section);
}