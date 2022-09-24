<?php
declare(strict_types=1);

namespace App\Actions;

use App\Actions\Contracts\CreateNewSubscriberContract;
use App\Events\Subscribers\Subscribed;
use App\Models\Subscriber;
use App\Notifications\Subscribers\SuccessfullySubscribed;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

final class CreateNewSubscriber implements CreateNewSubscriberContract
{
    public function handle(DataObjectContract $subscriber): Subscriber|Model
    {
        $subscriberModel = Subscriber::query()->create(
            attributes: $subscriber->toArray()
        );

        event(new Subscribed($subscriberModel->id));

        return $subscriberModel;
    }
}
