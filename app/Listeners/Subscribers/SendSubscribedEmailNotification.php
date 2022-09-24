<?php

namespace App\Listeners\Subscribers;

use App\Enums\Currency;
use App\Events\Subscribers\Subscribed;
use App\Models\Subscriber;
use App\Notifications\Subscribers\SuccessfullySubscribed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSubscribedEmailNotification implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(Subscribed $event): void
    {
        $subscriber = Subscriber::find($event->subscriberId);

        // Can be changed to pick up desired currencies from user. For the purposes of this demo, BTC and USD are hardcoded.
        $fromCurrency = 'BTC';
        $toCurrency = 'USD';
        $limit = $subscriber->btc_to_usd_limit;

        $subscriber->notify(new SuccessfullySubscribed($fromCurrency, $toCurrency, $limit));
    }
}
