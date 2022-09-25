<?php

declare(strict_types=1);

namespace App\Notifications\Subscribers;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class SuccessfullySubscribed extends Notification implements ShouldQueue
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
        $appName = config(key: 'app.name');
        $limit = $notifiable->btc_to_usd_limit;

        // Can be changed to pick up desired currencies from user. For the purposes of this demo, BTC and USD are hardcoded.
        $fromCurrency = 'BTC';
        $toCurrency = 'USD';

        return (new MailMessage)
                    ->line(
                        line:
                        __(
                            key: 'subscribers.you-have-successfully-subscribed',
                            replace: [
                                'app_name' => $appName,
                                'from_currency' => $fromCurrency,
                                'to_currency' => $toCurrency,
                            ]
                        )
                    )
                    ->line(
                        line:
                        __(
                            key: 'subscribers.you-will-be-notified-when-exceeds',
                            replace: ['limit' => $limit.' '.$toCurrency]
                        )
                    )
                    ->line(
                        line:
                        __(
                            key: 'common.thank-you-for-using',
                            replace: ['app_name' => $appName]
                        )
                    );
    }
}
