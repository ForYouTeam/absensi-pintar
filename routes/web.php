<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DaftarHadirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GateController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KetentuanController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/'             , [DashboardController   ::class, 'index'   ])->name('dashboard'       );
Route::get('/jurusan'      , [JurusanController     ::class, 'getView' ])->name('pages.jurusan'   );
Route::get('/jabatan'      , [JabatanController     ::class, 'getView' ])->name('pages.jabatan'   );
Route::get('/mapel'        , [MapelController       ::class, 'getView' ])->name('pages.mapel'     );
Route::get('/kelas'        , [KelasController       ::class, 'getView' ])->name('pages.kelas'     );
Route::get('/siswa'        , [SiswaController       ::class, 'getView' ])->name('pages.siswa'     );
Route::get('/guru'         , [GuruController        ::class, 'getView' ])->name('pages.guru'      );
Route::get('/ketentuan'    , [KetentuanController   ::class, 'getView' ])->name('pages.ketentuan' );
Route::get('/daftar_hadir' , [DaftarHadirController ::class, 'getView' ])->name('pages.absen'     );
Route::get('/report'       , [ReportController      ::class, 'getView' ])->name('pages.report'    );
Route::get('/gate'         , [GateController        ::class, 'getView' ])->name('pages.gate'      );
Route::get('/akun'         , [AkunController        ::class, 'getView' ])->name('Auth.Akun'       );


Route::prefix('dashboard')->controller(WebController::class)->group(function() 
{
  Route::get('/'          , 'dashboardPanel'    )->name('dashboard-panel');
  Route::get('/{section}' , 'siswaSectionPanel' );
});