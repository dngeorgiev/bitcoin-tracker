<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Subscribers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique(table: 'subscribers', column: 'email'),
            ],
            'btc_to_usd_limit' => [
                'required',
                'numeric',
            ],
        ];
    }
}
