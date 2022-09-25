<?php

declare(strict_types=1);

namespace App\Http\Resources\TickerData;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

final class TickerDatumResponse extends JsonResource
{
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'price' => intval($this->price),
            'date' => $this->date,
        ];
    }
}
