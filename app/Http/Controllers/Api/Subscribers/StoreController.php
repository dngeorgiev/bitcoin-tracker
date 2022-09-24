<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Subscribers;

use App\Actions\Contracts\CreateNewSubscriberContract;
use App\DataObjects\SubscriberObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subscribers\StoreRequest;
use Illuminate\Http\JsonResponse;
use JustSteveKing\DataObjects\Facades\Hydrator;
use Symfony\Component\HttpFoundation\Response;

final class StoreController extends Controller
{
    public function __construct(
        private readonly CreateNewSubscriberContract $action
    ) {}

    public function __invoke(StoreRequest $request): JsonResponse
    {
        $subscriber = $this->action->handle(
            subscriber: Hydrator::fill(
                class: SubscriberObject::class,
                properties: [
                    'email' => $request->get('email'),
                    'btc_to_usd_limit' => $request->get('btc_to_usd_limit')
                ]
            )
        );

        return new JsonResponse(
            data: $subscriber,
            status: Response::HTTP_CREATED
        );
    }
}
