<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DaftarHadirController;
use App\Http\Controllers\GateController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KetentuanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/jurusan')->controller(JurusanController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/mapel')->controller(MapelController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/jabatan')->controller(JabatanController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/kelas')->controller(KelasController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/guru')->controller(GuruController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/siswa')->controller(SiswaController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/ketentuan')->controller(KetentuanController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/akun')->controller(AkunController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::delete ('/{id}' , 'deletePayloadData' );
});

Route::prefix('v1/gate')->controller(GateController::class)->group(function () {
	Route::post('/open'              , 'openGate'          );
	Route::get ('/close/{rfid}'      , 'closeGate'         );
	Route::get ('/forceclose/{rfid}' , 'forceCloseGate'    );
	Route::get ('/closeall'          , 'forceCloseAllGate' );
	Route::get ('/all'               , 'getAllData'        );
});

Route::prefix('v1/present')->controller(DaftarHadirController::class)->group(function () {
	Route::post('/start'    , 'presentStart' );
	Route::get('/getbyqty/{gateId}' , 'getDataByQty' );
});

Route::prefix('v1/log')->controller(LogController::class)->group(function () {
	Route::get ('/get' , 'getAllLog' );
	Route::post('/set' , 'postLogs'  );
});