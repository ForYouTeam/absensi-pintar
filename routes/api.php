<?php

use App\Http\Controllers\JurusanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/jurusan')->controller(JurusanController::class)->group(function () {
	Route::get    ('/'     , 'getPayloadData'    );
	Route::get    ('/{id}' , 'getPayloadDataId'  );
	Route::post   ('/'     , 'upsertPayloadData' );
	Route::get ('/{id}' , 'deletePayloadData' );
});
