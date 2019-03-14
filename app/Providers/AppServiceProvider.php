<?php

namespace App\Providers;

use App\Http\Services\RoleService;
use App\Interfaces\Services\IRoleService;
use App\Http\Services\UserService;
use App\Interfaces\Services\IUserService;


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
    }
}
