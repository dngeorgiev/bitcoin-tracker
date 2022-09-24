<?php

declare(strict_types=1);

namespace App\DataObjects;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class SubscriberObject implements DataObjectContract
{
    public function __construct(
        public readonly string $email,
        public readonly float $btc_to_usd_limit
    ) {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'btc_to_usd_limit' => $this->btc_to_usd_limit,
        ];
    }
}
