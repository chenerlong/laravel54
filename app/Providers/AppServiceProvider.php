<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //mb4string
        Schema::defaultStringLength(191);

        \View::composer('layout.sidebar', function($view){
            $topics = \App\Topic::all();
            $view->with('topics', $topics);
        });

        \View::composer('layout.nav', function($view){
            $user = \Auth::user();
            $view->with('user', $user);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
