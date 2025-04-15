<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        
        $topUsers = Cache::remember("topUsers", Carbon::now()->addMinutes(3), function(){
            return User::withCount('ideas')->orderBy('ideas_count', 'desc')->take(5)->get();
        });

        View::share('topUsers', $topUsers);

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
