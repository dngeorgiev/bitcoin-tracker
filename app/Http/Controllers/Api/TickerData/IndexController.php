<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\TickerData;

use App\Enums\ChartType;
use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Http\Resources\TickerData\TickerDatumResponse;
use App\Models\TickerDatum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class IndexController extends Controller
{
    public function __invoke(Currency $fromCurrency, Currency $toCurrency, ChartType $chartType, Request $request): JsonResponse
    {
        $tickerData = TickerDatum::query()
            ->fromCurrencyToCurrency(
                fromCurrency: $fromCurrency,
                toCurrency: $toCurrency
            )
            ->byChartType(
                chartType: $chartType
            )
            ->get();

        return new JsonResponse(
            data: TickerDatumResponse::collection($tickerData),
            status: Response::HTTP_OK
        );
    }
}
