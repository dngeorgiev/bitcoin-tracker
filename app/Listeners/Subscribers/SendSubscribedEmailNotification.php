<?php

namespace App\Listeners\Subscribers;

use App\Enums\Currency;
use App\Events\Subscribers\Subscribed;
use App\Models\Subscriber;
use App\Notifications\Subscribers\SuccessfullySubscribed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

final class SendSubscribedEmailNotification implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(Subscribed $event): void
    {
        $subscriber = Subscriber::query()->find($event->subscriberId);

        $subscriber->notify(new SuccessfullySubscribed());
    }
}
