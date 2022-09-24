<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Subscribers\CreateNewSubscriber;
use App\Actions\Subscribers\CreateNewSubscriberContract;
use App\Actions\TickerData\BitfinexCollectTickerDatum;
use App\Actions\TickerData\CollectTickerDatumContract;
use App\Actions\TickerData\StoreNewTickerDatum;
use App\Actions\TickerData\StoreNewTickerDatumContract;
use Illuminate\Support\ServiceProvider;

final class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CreateNewSubscriberContract::class => CreateNewSubscriber::class,
        StoreNewTickerDatumContract::class => StoreNewTickerDatum::class,
        CollectTickerDatumContract::class => BitfinexCollectTickerDatum::class,
    ];
}
