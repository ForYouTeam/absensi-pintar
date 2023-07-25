<?php

namespace App\Interfaces;

interface GuruInterface {
  public function getAllPayload();
  public function getByRfid($rfid);
  public function deletePayload($id);
  public function getPayloadById($id);
  public function upsertPayload($id, array $payload);
}