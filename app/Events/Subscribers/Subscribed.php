<?php
declare(strict_types=1);

namespace App\Events\Subscribers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class Subscribed
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public readonly int $subscriberId
    )
    {}

    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}
