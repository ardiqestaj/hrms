<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
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
        // $notification = Notification::where('read_at', null)->get()
        // View::composer('*', function ($view) {
        //     //
        // });

    
    // View::share('city_zip_address', $city_zip_address);
        

    }
}
