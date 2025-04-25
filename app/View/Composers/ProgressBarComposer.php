<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Pin;

class ProgressBarComposer
{
    public function compose(View $view)
    {
        $totalPins = Pin::count();
        if (Auth::check()) {
            $user = Auth::user();
            
            $userPinsCount = $user->pins()->count();

            $progressPercentage = $totalPins > 0 ? ($userPinsCount / $totalPins) * 100 : 5;

            $view->with('progressPercentage', $progressPercentage);
            $view->with('totalPins', $totalPins);
            $view->with('userPinsCount', $userPinsCount);
        } else {
            $view->with('progressPercentage', 5);
            $view->with('totalPins', $totalPins);
            $view->with('userPinsCount', 0);
        }
    }
}