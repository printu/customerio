<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Events extends Base
{
    /**
     * Add anonymous event
     * @see http://customer.io/docs/invitation-emails.html
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function anonymous(array $options)
    {
        if (!isset($options['name'])) {
            $this->mockException('Name is required!', 'POST');
        } // @codeCoverageIgnore

        return $this->client->post("events", $options);
    }
}
