<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Activities extends Base
{
    /**
     * Get data about activities
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->activitiesPath();

        return $this->client->get($path, $options);
    }
}
