<?php

declare(strict_types=1);

namespace App\Jobs\TickerData;

use App\Actions\TickerData\CollectTickerDatumContract;
use App\Actions\TickerData\StoreNewTickerDatumContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

final class CollectBtcToUsdTickerDatum implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private const FROM_CURRENCY = 'btc';

    private const TO_CURRENCY = 'usd';

    public function handle(CollectTickerDatumContract $collectAction, StoreNewTickerDatumContract $storeAction): void
    {
        try {
            $dto = $collectAction->handle(self::FROM_CURRENCY, self::TO_CURRENCY);

            $storeAction->handle(
                tickerDatum: $dto
            );
        } catch (\Exception $ex) {
            // Could be made way more fashionable - notify administrator by e-mail or something like that.
            Log::error($ex->getMessage());
        }
    }
}
