<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\LinkRepository;
use Exception;

class ShortenerUrlService
{
    protected LinkRepository $shortenerUrlRepository;

    public function __construct()
    {
        $this->shortenerUrlRepository = app(LinkRepository::class);
    }

    /**
     * @param array $shortLinkAttributes
     * @param array $tags
     *
     * @return string
     * @throws Exception
     */
    public function createShortLink(array $shortLinkAttributes, array $tags): string
    {
        $shortLink = $this->shortenerUrlRepository->getShortLinkByOriginalLink($shortLinkAttributes['long_url']);

        if ($shortLink) {
            return $shortLink->short_code;
        }

        $shortCode = $this->generateShortCode();
        $shortLink = $this->shortenerUrlRepository->createShortLink([
            'short_code' => $shortCode,
            'original_link' => $shortLinkAttributes['long_url'],
            'title' => $shortLinkAttributes['title'],
        ]);

        return $shortLink->short_code;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function generateShortCode(): string
    {
        $shortCode = bin2hex(random_bytes(2)) . substr(sha1((string)time()), 0, 2);

        return $shortCode;
    }

}
