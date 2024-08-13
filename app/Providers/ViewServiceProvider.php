<?php

namespace App\Providers;

use App\Models\ContactMe;
use App\Models\Directive;
use App\Models\Faq;
use App\Models\LocationEvent;
use App\Models\Organized;
use App\Models\Race;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['components.home.app', 'welcome'], function ($view) {
            $view->with('con', ContactMe::first());
            $view->with('races', Race::with(['category'])->get());
            $view->with('directives', Directive::all());
            $view->with('faqs', Faq::all());
            $view->with('loc', LocationEvent::first());
            $view->with('organizeds', Organized::all()->groupBy('type'));
        });
    }
}
