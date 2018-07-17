<?php

namespace Customerio\Endpoint;

class Events extends Base
{
    /**
     * Add anonymous event
     * @see http://customer.io/docs/invitation-emails.html
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function anonymous(array $options)
    {
        if (!isset($options['name'])) {
            $this->mockException('Name is required!', 'POST');
        } // @codeCoverageIgnore

        return $this->client->post("events", $options);
    }
}
