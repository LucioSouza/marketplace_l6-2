<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {
    /*
     * Não esquecer de criá-lo através do terminal: php artisan make:provider NameOfProvider
     */

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {


        $shareWith = array(
            'layouts.front',
        );

        view()->composer($shareWith, 'App\Http\Views\CategoryViewComposer@compose');
    }

}
