<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KetentuanController;
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