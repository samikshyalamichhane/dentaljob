<?php

namespace App\Providers;

use App\ViewComposer\MasterComposer;
use App\ViewComposer\ViewComposer;
use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        View::composer('*', ViewComposer::class);
        View::composer('*', MasterComposer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
