<?php

namespace App\Interfaces;

interface KetentuanInterface {
  public function getAllPayload();
  public function checkPayload($tipe);
  public function deletePayload($id);
  public function getPayloadById($id);
  public function upsertPayload($id, array $payload);
}