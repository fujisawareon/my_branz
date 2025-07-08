<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $repo_list = require __DIR__ . '/repo_list.php';
        foreach ($repo_list as $repo) {
            $this->app->bind($repo['interface'], $repo['class']);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
