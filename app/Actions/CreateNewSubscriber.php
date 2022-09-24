<?php
declare(strict_types=1);

namespace App\Actions;

use App\Actions\Contracts\CreateNewSubscriberContract;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class CreateNewSubscriber implements CreateNewSubscriberContract
{
    public function handle(DataObjectContract $subscriber): Subscriber|Model
    {
        return Subscriber::query()->create(
            attributes: $subscriber->toArray()
        );
    }
}
