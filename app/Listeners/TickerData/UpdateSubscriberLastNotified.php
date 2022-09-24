<?php

namespace App\Listeners\TickerData;

use App\Notifications\TickerData\PriceExceededLimit;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;

final class UpdateSubscriberLastNotified implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(NotificationSent $event): void
    {
        $notification = $event->notification;

        if ($notification instanceof PriceExceededLimit) {
            $subscriber = $event->notifiable;

            $subscriber->update([
                'last_notified_at' => Carbon::now()
            ]);
        }
    }
}
