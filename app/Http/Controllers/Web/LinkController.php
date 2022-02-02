<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\LinkService;
use Illuminate\Http\RedirectResponse;

class LinkController extends Controller
{
    /**
     * @param string $shortCode
     * @param LinkService $linkService
     *
     * @return RedirectResponse
     */
    public function redirectToOriginalLink(string $shortCode, LinkService $linkService): RedirectResponse
    {
        $originalLink = $linkService->getOriginalLinkByShortCode($shortCode);

        if ($originalLink === null) {
            return redirect('/');
        }

        return redirect($originalLink);
    }
}
