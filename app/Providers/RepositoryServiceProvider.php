<?php

namespace App\Providers;

use App\Interfaces\AkunInterface;
use App\Interfaces\DaftarHadirInterface;
use App\Interfaces\GateInterface;
use App\Interfaces\GuruInterface;
use App\Interfaces\JabatanInterface;
use App\Interfaces\JurusanInterface;
use App\Interfaces\KelasInterface;
use App\Interfaces\KetentuanInterface;
use App\Interfaces\LogInterface;
use App\Interfaces\MapelInterface;
use App\Interfaces\SiswaInterface;
use App\Repositories\AkunRepository;
use App\Repositories\DaftarHadirRepository;
use App\Repositories\GateRepository;
use App\Repositories\GuruRepository;
use App\Repositories\JabatanRepository;
use App\Repositories\JurusanRepository;
use App\Repositories\KelasRepository;
use App\Repositories\KetentuanRepository;
use App\Repositories\LogRepository;
use App\Repositories\MapelRepository;
use App\Repositories\SiswaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(JurusanInterface   ::class, JurusanRepository   ::class);
        $this->app->bind(MapelInterface     ::class, MapelRepository     ::class);
        $this->app->bind(JabatanInterface   ::class, JabatanRepository   ::class);
        $this->app->bind(KelasInterface     ::class, KelasRepository     ::class);
        $this->app->bind(GuruInterface      ::class, GuruRepository      ::class);
        $this->app->bind(SiswaInterface     ::class, SiswaRepository     ::class);
        $this->app->bind(KetentuanInterface ::class, KetentuanRepository ::class);
        $this->app->bind(AkunInterface      ::class, AkunRepository      ::class);
        $this->app->bind(JurusanInterface     ::class, JurusanRepository     ::class);
        $this->app->bind(MapelInterface       ::class, MapelRepository       ::class);
        $this->app->bind(JabatanInterface     ::class, JabatanRepository     ::class);
        $this->app->bind(KelasInterface       ::class, KelasRepository       ::class);
        $this->app->bind(GuruInterface        ::class, GuruRepository        ::class);
        $this->app->bind(SiswaInterface       ::class, SiswaRepository       ::class);
        $this->app->bind(KetentuanInterface   ::class, KetentuanRepository   ::class);
        $this->app->bind(GateInterface        ::class, GateRepository        ::class);
        $this->app->bind(DaftarHadirInterface ::class, DaftarHadirRepository ::class);
        $this->app->bind(LogInterface         ::class, LogRepository         ::class);
    }
}
