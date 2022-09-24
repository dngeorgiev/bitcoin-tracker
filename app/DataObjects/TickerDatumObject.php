<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Currency;
use Carbon\Carbon;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class TickerDatumObject implements DataObjectContract
{
    public function __construct(
        public readonly float $bid,
        public readonly float $ask,
        public readonly float $last_price,
        public readonly Currency $from_currency,
        public readonly Currency $to_currency,
        public readonly Carbon $valid_at,
        public readonly Carbon $inserted_at,
    ) {}

    public function toArray(): array
    {
        return [
            'bid' => $this->bid,
            'ask' => $this->ask,
            'last_price' => $this->last_price,
            'from_currency' => $this->from_currency,
            'to_currency' => $this->to_currency,
            'valid_at' => $this->valid_at,
            'inserted_at' => $this->inserted_at,
        ];
    }
}
