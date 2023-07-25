<?php

namespace App\Interfaces;

interface SiswaInterface {
  public function getAllPayload();
  public function getByKelas($kelas);
  public function findByRfid($rfid);
  public function deletePayload($id);
  public function getPayloadById($id);
  public function upsertPayload($id, array $payload);
}