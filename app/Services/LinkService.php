<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\LinkRepository;

class LinkService
{
    protected LinkRepository $shortenerUrlRepository;

    public function __construct()
    {
        $this->shortenerUrlRepository = app(LinkRepository::class);
    }

    /**
     * @param string $shortCode
     *
     * @return string|null
     */
    public function getOriginalLinkByShortCode(string $shortCode): ?string
    {
        $shortLink = $this->shortenerUrlRepository->getShortLinkByShortCode($shortCode);

        return $shortLink->original_link ?? null;
    }
}
