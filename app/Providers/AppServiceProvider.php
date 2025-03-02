<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $questCount = Task::where('assigned_to', Auth::user()->id)->whereHas('creator', function ($query) {
                    $query->where('role', 'tasker');
                })
                ->whereHas('taskDetail', function ($query) {
                        $query->where('status', false);
                })
                ->count();
            } else {
                $questCount = 0;
            }
            $view->with('questCount', $questCount);
        });
    }
}
