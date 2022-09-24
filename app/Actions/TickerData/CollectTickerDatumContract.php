<?php
declare(strict_types=1);

namespace App\Actions\TickerData;

use JustSteveKing\DataObjects\Contracts\DataObjectContract;

interface CollectTickerDatumContract
{
    public function handle(string $fromCurrency, string $toCurrency): DataObjectContract;
}
