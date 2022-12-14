<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            provider: ActionsServiceProvider::class
        );
    }

    public function boot(): void
    {
    }
}
