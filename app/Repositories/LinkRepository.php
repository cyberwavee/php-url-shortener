<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class LinkRepository
{
    /**
     * @return Builder
     */
    public function queryObject(): Builder
    {
        return ShortLink::query();
    }

    /**
     * @param string $originalLink
     *
     * @return ShortLink|null
     */
    public function getShortLinkByOriginalLink(string $originalLink): ?ShortLink
    {
        /** @var ShortLink|null $shortLink */
        $shortLink = $this->queryObject()->where('original_link', $originalLink)->first();

        return $shortLink;
    }

    /**
     * @param string $shortCode
     *
     * @return ShortLink|null
     */
    public function getShortLinkByShortCode(string $shortCode): ?ShortLink
    {
        /** @var ShortLink|null $shortLink */
        $shortLink = $this->queryObject()->where('short_code', $shortCode)->first();

        return $shortLink;
    }

    /**
     * @param array $attributes
     *
     * @return ShortLink
     */
    public function createShortLink(array $attributes): ShortLink
    {
        $data = Arr::only($attributes, ['short_code', 'original_link']);

        /** @var ShortLink $shortLink */
        $shortLink = $this->queryObject()->create($data);

        return $shortLink;
    }
}
