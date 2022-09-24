<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Currency;
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
}
