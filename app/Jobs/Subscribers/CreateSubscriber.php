<?php

declare(strict_types=1);

namespace App\Jobs\Subscribers;

use App\Actions\Subscribers\CreateNewSubscriberContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class CreateSubscriber implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly DataObjectContract $subscriber,
    ) {
    }

    public function handle(CreateNewSubscriberContract $action): void
    {
        $action->handle(
            subscriber: $this->subscriber
        );
    }
}
