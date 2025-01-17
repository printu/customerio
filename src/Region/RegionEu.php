<?php

declare(strict_types=1);

namespace Customerio\Region;

class RegionEu implements RegionInterface
{
    public function trackUri(string $version = 'v1'): string
    {
        return 'https://track-eu.customer.io/api/'.$version.'/';
    }

    public function apiUri(): string
    {
        return 'https://api-eu.customer.io/v1/';
    }
}
