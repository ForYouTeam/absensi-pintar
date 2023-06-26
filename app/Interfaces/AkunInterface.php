<?php

namespace App\Interfaces;

interface AkunInterface {
  public function getAllPayload();
  public function getPayloadById($id);
  public function upsertPayload($id, array $payload);
  public function deletePayload($id);
}