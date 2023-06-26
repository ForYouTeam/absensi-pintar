<?php

namespace App\Interfaces;

interface LogInterface {
  public function SetLog(array $payload);
  public function GetLog(array $meta);
}