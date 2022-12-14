<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Currency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

final class Subscriber extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'email',
        'btc_to_usd_limit',
        'last_notified_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_notified_at' => 'datetime',
    ];

    /* Begin Scopes */

    public function scopeNotifiedBefore(Builder $query, int $interval): Builder
    {
        return $query
            ->where(
                column: 'last_notified_at',
                operator:'<=',
                value: Carbon::now()->subMinutes($interval)->toDateTimeString()
            )
            ->orWhereNull(column: 'last_notified_at');
    }

    public function scopeLimitExceeds(Builder $query, float $limit, Currency $fromCurrency = Currency::BTC, Currency $toCurrency = Currency::USD): Builder
    {
        // From and to currency are currently hardcoded for the purposes of the demo
        return $query->where(
            column:'btc_to_usd_limit',
            operator: '<',
            value: $limit
        );
    }

    /* End Scopes */
}
