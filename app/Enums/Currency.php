<?php
declare(strict_types=1);

namespace App\Enums;

enum Currency: string
{
    case BTC = 'btc';
    case USD = 'usd';
}
