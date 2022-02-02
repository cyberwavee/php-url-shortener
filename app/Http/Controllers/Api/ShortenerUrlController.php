<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortenUrlRequest;
use App\Services\ShortenerUrlService;
use Exception;
use Illuminate\Http\JsonResponse;
use function response;

class ShortenerUrlController extends Controller
{
    /**
     * @param ShortenUrlRequest $request
     * @param ShortenerUrlService $shortenerUrlService
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function shortenUrl(ShortenUrlRequest $request, ShortenerUrlService $shortenerUrlService): JsonResponse
    {
        $originalLink = $request->get('url_link');

        return response()->json(['data' => [
            'url' => env('APP_URL') . '/' . $shortenerUrlService->createShortLink($originalLink),
        ]]);
    }
}
