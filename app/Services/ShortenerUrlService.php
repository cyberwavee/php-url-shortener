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
     * @param string $originalLink
     *
     * @return string
     * @throws Exception
     */
    public function createShortLink(string $originalLink): string
    {
        $shortLink = $this->shortenerUrlRepository->getShortLinkByOriginalLink($originalLink);

        if ($shortLink) {
            return $shortLink->short_code;
        }

        $shortCode = $this->generateShortCode();
        $shortLink = $this->shortenerUrlRepository->createShortLink([
            'short_code' => $shortCode,
            'original_link' => $originalLink,
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
