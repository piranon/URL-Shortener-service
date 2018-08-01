<?php

namespace App\Providers;

use App\Factories\EloquentURLFactory;
use App\Factories\URLFactoriesInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\URLRepositoryInterface;
use App\Repositories\URLRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(URLRepositoryInterface::class, URLRepository::class);
        $this->app->bind(URLFactoriesInterface::class, EloquentURLFactory::class);
    }
}
