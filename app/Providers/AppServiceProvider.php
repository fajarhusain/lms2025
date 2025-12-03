<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::addNamespace('operator', resource_path('views/pages/admin'));
        View::addNamespace('student', resource_path('views/pages/student'));
        View::addNamespace('teacher', resource_path('views/pages/teacher'));
    }
}
