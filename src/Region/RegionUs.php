<?php

declare(strict_types=1);

namespace Customerio\Region;

class RegionUs implements RegionInterface
{
    public function trackUri(): string
    {
        return 'https://track.customer.io/api/v1/';
    }

    public function apiUri(): string
    {
        return 'https://api.customer.io/v1/';
    }

    public function betaUri(): string
    {
        return 'https://beta-api.customer.io/v1/api/';
    }
}
