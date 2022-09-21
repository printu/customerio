<?php

declare(strict_types=1);

namespace Customerio\Region;

class RegionEu implements RegionInterface
{
    public function trackUri(): string
    {
        return 'https://track-eu.customer.io/api/v1/';
    }

    public function apiUri(): string
    {
        return 'https://api-eu.customer.io/v1/';
    }
}
