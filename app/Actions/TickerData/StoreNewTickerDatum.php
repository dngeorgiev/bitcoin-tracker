<?php

declare(strict_types=1);

namespace App\Actions\TickerData;

use App\Events\TickerData\TickerDatumStored;
use App\Models\TickerDatum;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class StoreNewTickerDatum implements StoreNewTickerDatumContract
{
    public function handle(DataObjectContract $tickerDatum): TickerDatum|Model
    {
        $tickerDatumObject = TickerDatum::query()->create(
            attributes: $tickerDatum->toArray()
        );

        event(new TickerDatumStored($tickerDatumObject->id));

        return $tickerDatumObject;
    }
}
