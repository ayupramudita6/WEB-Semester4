<?php

namespace App\Providers;

use App\Services\SomeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SomeService::class, function ($app) {
            return new SomeService();
        });
    }
}