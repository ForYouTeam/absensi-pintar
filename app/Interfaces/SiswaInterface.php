<?php

namespace App\Interfaces;

interface SiswaInterface {
  public function getAllPayload();
  public function findByRfid($rfid);
  public function deletePayload($id);
  public function getPayloadById($id);
  public function upsertPayload($id, array $payload);
}