<?php

namespace App\Providers;

use App\Interfaces\GuruInterface;
use App\Interfaces\JabatanInterface;
use App\Interfaces\JurusanInterface;
use App\Interfaces\KelasInterface;
use App\Interfaces\MapelInterface;
use App\Repositories\GuruRepository;
use App\Repositories\JabatanRepository;
use App\Repositories\JurusanRepository;
use App\Repositories\KelasRepository;
use App\Repositories\MapelRepository;
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
        $this->app->bind(JurusanInterface::class, JurusanRepository::class);
        $this->app->bind(MapelInterface  ::class, MapelRepository  ::class);
        $this->app->bind(JabatanInterface::class, JabatanRepository::class);
        $this->app->bind(KelasInterface  ::class, KelasRepository  ::class);
        $this->app->bind(GuruInterface   ::class, GuruRepository   ::class);
    }
}
