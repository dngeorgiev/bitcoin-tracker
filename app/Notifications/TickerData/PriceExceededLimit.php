<?php

declare(strict_types=1);

namespace App\Notifications\TickerData;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class PriceExceededLimit extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
    }

    public function via(Subscriber $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(Subscriber $notifiable): MailMessage
    {
        $appName = config('app.name');
        $limit = $notifiable->btc_to_usd_limit;

        // Can be changed to pick up desired currencies from user. For the purposes of this demo, BTC and USD are hardcoded.
        $fromCurrency = 'BTC';
        $toCurrency = 'USD';

        return (new MailMessage)
            ->line(
                __(
                    'subscribers.the-price-of-x-has-exceeded-the-limit',
                    [
                        'limit' => $limit,
                        'from_currency' => $fromCurrency,
                        'to_currency' => $toCurrency,
                    ]
                )
            )
            ->line(
                __(
                    'common.thank-you-for-using',
                    ['app_name' => $appName]
                )
            );
    }
}
