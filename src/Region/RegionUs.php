<?php

declare(strict_types=1);

namespace Customerio\Region;

class RegionUs implements RegionInterface
{
    public function trackUri(string $version = 'v1'): string
    {
        return 'https://track.customer.io/api/'.$version.'/';
    }

    public function apiUri(): string
    {
        return 'https://api.customer.io/v1/';
    }
}
