<?php

namespace Customerio\Endpoint;

class Campaigns extends Base
{
    /**
     * Trigger Campaign Broadcast
     * @see https://learn.customer.io/api/#apibroadcast_trigger
     * @see https://learn.customer.io/documentation/api-triggered-data-format.html
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function trigger(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'POST');
        }

        $path = $this->campaignPath($options['id']);
        unset($options['id']);

        return $this->client->post($path."/triggers", $options);
    }
}
