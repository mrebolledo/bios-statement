<?php

namespace App\App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        setlocale(LC_TIME, 'es_ES');
        Schema::defaultStringLength(191);
        Carbon::setLocale('es');
        DB::disableQueryLog();
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
