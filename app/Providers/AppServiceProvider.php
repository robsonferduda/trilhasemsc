<?php

namespace App\Providers;

use App\Evento;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });

        $evento = Evento::where('dt_realizacao_eve','>',date('Y-m-d H:i:s'))->inRandomOrder()->take(1)->first();

        View::share('eventoBanner', $evento);


    }
}
