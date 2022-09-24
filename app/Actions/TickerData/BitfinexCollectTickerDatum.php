<?php

declare(strict_types=1);

namespace App\Actions\TickerData;

use App\DataObjects\TickerDatumObject;
use Carbon\Carbon;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;
use JustSteveKing\DataObjects\Facades\Hydrator;

final class BitfinexCollectTickerDatum implements CollectTickerDatumContract
{
    private const API_URL = 'https://api.bitfinex.com/v1/pubticker/';

    /**
     * @throws RequestException
     */
    public function handle(string $fromCurrency, string $toCurrency): DataObjectContract
    {
        $fullUrl = self::API_URL.$fromCurrency.$toCurrency;

        $response = Http::acceptJson()->get($fullUrl);

        if ($response->failed()) {
            $response->throw();
        }

        $responseBody = $response->json();

        return Hydrator::fill(
            class: TickerDatumObject::class,
            properties: [
                'bid' => floatval($responseBody['bid']),
                'ask' => floatval($responseBody['ask']),
                'last_price' => floatval($responseBody['last_price']),
                'from_currency' => $fromCurrency,
                'to_currency' => $toCurrency,
                'valid_at' => Carbon::createFromTimestamp($responseBody['timestamp']),
                'inserted_at' => Carbon::now(),
            ]
        );
    }
}
