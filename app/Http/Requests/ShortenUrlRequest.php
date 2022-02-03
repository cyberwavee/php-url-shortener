<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortenUrlRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'long_url' => 'required|url',
            'title' => 'required|string',
            'tags' => 'nullable|array'
        ];
    }
}
