<?php

declare(strict_types=1);

namespace App\Actions\TickerData;

use App\Models\TickerDatum;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

interface StoreNewTickerDatumContract
{
    public function handle(DataObjectContract $tickerDatum): TickerDatum|Model;
}
