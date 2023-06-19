<?php

namespace App\Providers;

use App\Interfaces\JurusanInterface;
use App\Repositories\JurusanRepository;
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
    }
}
