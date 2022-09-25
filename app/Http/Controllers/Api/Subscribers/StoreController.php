<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Subscribers;

use App\DataObjects\SubscriberObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Subscribers\StoreRequest;
use App\Jobs\Subscribers\CreateSubscriber;
use Illuminate\Http\JsonResponse;
use JustSteveKing\DataObjects\Facades\Hydrator;
use Symfony\Component\HttpFoundation\Response;

final class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        dispatch(new CreateSubscriber(
            subscriber: Hydrator::fill(
                class: SubscriberObject::class,
                properties: [
                    'email' => $request->get('email'),
                    'btc_to_usd_limit' => floatval($request->get('btc_to_usd_limit')),
                ]
            )
        ));

        return new JsonResponse(
            data: null,
            status: Response::HTTP_ACCEPTED
        );
    }
}
