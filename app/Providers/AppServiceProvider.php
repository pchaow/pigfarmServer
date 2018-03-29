<?php

namespace App\Providers;

use App\Http\Services\RoleService;
use App\Interfaces\Services\IRoleService;
use Illuminate\Support\ServiceProvider;

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

        \App::bind(IRoleService::class, RoleService::class);

    }
}
