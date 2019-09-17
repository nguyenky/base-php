<?php

namespace Ky\Core;

use Illuminate\Support\ServiceProvider;
use Ky\Core\Commands\MakeRepository;
use Ky\Core\Commands\MakeService;
use Ky\Core\Commands\MakeFilter;
use Ky\Core\Commands\MakeCriteria;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepository::class,
                MakeService::class,
                MakeFilter::class,
                MakeCriteria::class
            ]);
        }
    }
}
