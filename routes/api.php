<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MapelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/jurusan')->controller(JurusanController::class)->group(function () {
	Route::get  ('/'     , 'getPayloadData'    );
	Route::get  ('/{id}' , 'getPayloadDataId'  );
	Route::post ('/'     , 'upsertPayloadData' );
	Route::delete  ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/mapel')->controller(MapelController::class)->group(function () {
	Route::get  ('/'     , 'getPayloadData'    );
	Route::get  ('/{id}' , 'getPayloadDataId'  );
	Route::post ('/'     , 'upsertPayloadData' );
	Route::delete  ('/{id}' , 'deletePayloadData' );
});
