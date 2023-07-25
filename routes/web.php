<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
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

Route::get('/'             , [DashboardController   ::class, 'index'   ])->middleware(['auth'                                ])->name('dashboard'       );
Route::get('/jurusan'      , [JurusanController     ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin'      ])->name('pages.jurusan'   );
Route::get('/jabatan'      , [JabatanController     ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin'      ])->name('pages.jabatan'   );
Route::get('/mapel'        , [MapelController       ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin|guru' ])->name('pages.mapel'     );
Route::get('/kelas'        , [KelasController       ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin'      ])->name('pages.kelas'     );
Route::get('/siswa'        , [SiswaController       ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin|guru' ])->name('pages.siswa'     );
Route::get('/guru'         , [GuruController        ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin'      ])->name('pages.guru'      );
Route::get('/ketentuan'    , [KetentuanController   ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin'      ])->name('pages.ketentuan' );
Route::get('/daftar_hadir' , [DaftarHadirController ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin|guru' ])->name('pages.absen'     );
Route::get('/reportlog'    , [ReportController      ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin|guru' ])->name('pages.reportlog' );
Route::get('/gate'         , [GateController        ::class, 'getView' ])->middleware(['auth', 'role:super-admin|admin|guru' ])->name('pages.gate'      );
Route::get('/akun'         , [AkunController        ::class, 'getView' ])->middleware(['auth', 'role:super-admin'            ])->name('Auth.Akun'       );

Route::get ('/loginview'    , [AuthController ::class, 'index' ])->name('login'         );
Route::post('/loginprocess' , [AuthController ::class, 'login' ])->name('login-process' );
Route::get('/logout'       , [AuthController ::class, 'logout' ])->middleware(['auth'])->name('logout');

Route::prefix('dashboard')->controller(WebController::class)->group(function() 
{
  Route::get('/'          , 'dashboardPanel'    )->middleware(['auth', 'role:super-admin|admin|guru'])->name('dashboard-panel');
  Route::get('/{section}' , 'siswaSectionPanel' );
});