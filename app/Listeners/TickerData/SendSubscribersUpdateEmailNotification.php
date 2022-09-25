<?php

namespace App\Listeners\TickerData;

use App\Enums\Currency;
use App\Events\TickerData\TickerDatumStored;
use App\Models\Subscriber;
use App\Models\TickerDatum;
use App\Notifications\TickerData\PriceExceededLimit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

final class SendSubscribersUpdateEmailNotification implements ShouldQueue
{
    private const NOTIFY_INTERVAL_IN_MINUTES = 5;

    public function __construct()
    {
    }

    public function handle(TickerDatumStored $event): void
    {
        $tickerDatum = TickerDatum::query()->find(id: $event->tickerDatumId);

        // Can be changed to handle dynamic currencies.
        //  For the purposes of this demo, btc_to_usd_limit is hardcoded in one column.
        // A new column "notify_every_x_minutes" can be added to let the user choose how often should be notified.
        //  For the purposes of this demo, 5 minutes will be the hardcoded limit.
        Subscriber::query()
            ->notifiedBefore(interval: self::NOTIFY_INTERVAL_IN_MINUTES)
            ->limitExceeds(limit: $tickerDatum->last_price, fromCurrency: Currency::BTC, toCurrency: Currency::USD)
            ->chunk(50, function ($subscribers) {
                Notification::send(notifiables: $subscribers, notification: new PriceExceededLimit());
            });
    }
}
