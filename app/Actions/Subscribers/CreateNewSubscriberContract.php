<?php
declare(strict_types=1);

namespace App\Actions\Subscribers;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\DataObjects\Contracts\DataObjectContract;

interface CreateNewSubscriberContract
{
    public function handle(DataObjectContract $subscriber): Subscriber|Model;
}
