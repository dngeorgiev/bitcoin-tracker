<?php
declare(strict_types=1);

namespace App\Providers;

use App\Actions\Contracts\CreateNewSubscriberContract;
use App\Actions\CreateNewSubscriber;
use Illuminate\Support\ServiceProvider;

final class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CreateNewSubscriberContract::class => CreateNewSubscriber::class
    ];
}
