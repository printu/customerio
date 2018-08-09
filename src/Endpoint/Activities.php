<?php

namespace Customerio\Endpoint;

use Customerio\Client;

class Activities extends Base
{
    /**
     * Get data about activities
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->activitiesPath();
        $options['endpoint'] = Client::API_ENDPOINT_BETA;

        return $this->client->post($path, $options);
    }
}
