<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Subscribers\Subscribed;
use App\Listeners\Subscribers\SendSubscribedEmailNotification;
use App\Events\TickerData\TickerDatumStored;
use App\Listeners\TickerData\SendSubscribersUpdateEmailNotification;
use App\Listeners\TickerData\UpdateSubscriberLastNotified;
use Illuminate\Notifications\Events\NotificationSent;

final class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Subscribed::class => [
            SendSubscribedEmailNotification::class,
        ],
        TickerDatumStored::class => [
            SendSubscribersUpdateEmailNotification::class,
        ],
        NotificationSent::class => [
            UpdateSubscriberLastNotified::class
        ]
    ];

    public function boot(): void
    {
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
