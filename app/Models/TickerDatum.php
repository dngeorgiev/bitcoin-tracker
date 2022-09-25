<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ChartType;
use App\Enums\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class TickerDatum extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'from_currency' => Currency::class,
        'to_currency' => Currency::class,
        'valid_at' => 'datetime',
        'inserted_at' => 'datetime',
    ];

    /* Begin Scopes */

    public function scopeByChartType(Builder $query, ChartType $chartType): Builder
    {
        switch ($chartType) {
            case ChartType::HOURS_ONE:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (1*60)) * (1*60)) AS date';
                $validAfter = Carbon::now()->subHour();
                break;
            case ChartType::HOURS_SIX:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (5*60)) * (5*60)) AS date';
                $validAfter = Carbon::now()->subHours(value: 6);
                break;
            case ChartType::DAYS_ONE:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (15*60)) * (15*60)) AS date';
                $validAfter = Carbon::now()->subDay();
                break;
            case ChartType::DAYS_THREE:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (30*60)) * (30*60)) AS date';
                $validAfter = Carbon::now()->subDays(value: 3);
                break;
            case ChartType::DAYS_SEVEN:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (60*60)) * (60*60)) AS date';
                $validAfter = Carbon::now()->subDays(value: 7);
                break;
            case ChartType::MONTHS_ONE:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (6*60*60)) * (6*60*60)) AS date';
                $validAfter = Carbon::now()->subMonth();
                break;
            case ChartType::MONTHS_THREE:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (12*60*60)) * (12*60*60)) AS date';
                $validAfter = Carbon::now()->subMonths(value: 3);
                break;
            case ChartType::YEARS_THREE:
                $expression = 'AVG(last_price) as price,
                            FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (7*24*60*60)) * (7*24*60*60)) AS date';
                $validAfter = Carbon::now()->subYears(value: 3);
                break;
            case ChartType::YEARS_ONE:
            default:
                $expression = 'AVG(last_price) as price,
                                FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(valid_at) / (24*60*60)) * (24*60*60)) AS date';
                $validAfter = Carbon::now()->subYear();
                break;
        }

        return $query
            ->selectRaw(
                expression: $expression
            )
            ->where(
                column: 'valid_at',
                operator: '>=',
                value: $validAfter
            )
            ->groupBy(groups: 'date');
    }

    public function scopeFromCurrencyToCurrency(Builder $query, Currency $fromCurrency, Currency $toCurrency): Builder
    {
        return $query->where(column: 'from_currency', value: $fromCurrency)
                    ->where(column: 'to_currency', value: $toCurrency);
    }

    /* End Scopes */
}
