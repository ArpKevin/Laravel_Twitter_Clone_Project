<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\View\Composers\TopUserComposer;
use Illuminate\Support\Facades\URL;
use App\View\Composers\ProgressBarComposer;

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
        Paginator::useBootstrapFive();

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer(["*"], TopUserComposer::class);
        View::composer(["*"], ProgressBarComposer::class);
    }
}
