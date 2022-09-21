<?php

declare(strict_types=1);

namespace Customerio\Region;

interface RegionInterface
{
    /**
     * Behavioral Tracking
     *
     * @return string
     */
    public function trackUri(): string;

    /**
     * API
     *
     * @return string
     */
    public function apiUri(): string;
}
