<?php

declare(strict_types=1);

namespace Customerio;

use Customerio\Region\InvalidRegionException;
use Customerio\Region\RegionInterface;
use Customerio\Region\RegionEu;
use Customerio\Region\RegionUs;

class Region
{
    public static function factory(string $region = 'us'): RegionInterface
    {
        switch ($region) {
            case 'us':
                return new RegionUs();
            case 'eu':
                return new RegionEu();
            default:
                throw new InvalidRegionException("Unknown region: ${region}");
        }
    }
}
