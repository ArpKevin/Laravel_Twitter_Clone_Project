<?php

namespace App\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\User;

class TopUserComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('topUsers', User::withCount('ideas')->orderBy('ideas_count', 'desc')->take(5)->get());
    }
}