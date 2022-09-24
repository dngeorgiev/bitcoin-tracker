<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Subscribers\Subscribed;
use App\Listeners\Subscribers\SendSubscribedEmailNotification;

final class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Subscribed::class => [
            SendSubscribedEmailNotification::class,
        ],
    ];

    public function boot(): void
    {
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
