<?php
declare(strict_types=1);

namespace App\Notifications\Subscribers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class SuccessfullySubscribed extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly string $fromCurrency,
        public readonly string $toCurrency,
        public readonly float $limit,
    )
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $appName = config('app.name');

        return (new MailMessage)
                    ->line(
                        __(
                            'subscribers.you-have-successfully-subscribed',
                            [
                                'app_name' => $appName,
                                'from_currency' => $this->fromCurrency,
                                'to_currency' => $this->toCurrency
                            ]
                        )
                    )
                    ->line(
                        __(
                            'subscribers.you-will-be-notified-when-exceeds',
                            ['limit' => $this->limit . ' ' . $this->toCurrency]
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
