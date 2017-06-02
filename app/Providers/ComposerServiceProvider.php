<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Every time the navbar is going to be rendered, this will run the
     * navbar composer to get all links in the db and pass them to the view
     * @return void
     */
    public function boot()
    {
        view()->composer("shared.navbar", "App\Http\ViewComposers\NavbarComposer");
        view()->composer("shared.carousel", "App\Http\ViewComposers\CarouselComposer");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
