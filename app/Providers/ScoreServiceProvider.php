<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ScoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/ScoreHelper.php';
    }

    public function boot()
    {
        //
    }
}
