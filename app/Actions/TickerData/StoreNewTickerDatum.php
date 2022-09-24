<?php
declare(strict_types=1);

namespace App\Actions\TickerData;

use App\Models\TickerDatum;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class StoreNewTickerDatum implements StoreNewTickerDatumContract
{
    public function handle(DataObjectContract $tickerDatum): TickerDatum|Model
    {
        return TickerDatum::query()->create(
            attributes: $tickerDatum->toArray()
        );
    }
}
