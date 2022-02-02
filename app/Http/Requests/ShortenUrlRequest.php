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
            'url_link' => 'required|url'
        ];
    }
}
