<?php

namespace Customerio\Endpoint;

use Customerio\Client;

class SenderIdentities extends Base
{
    /**
     * Get sender identities data
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->senderIdentitiesPath();

        return $this->client->get($path, $options);
    }

    /**
     * Get sender identity data
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('The unique id of the sender identity is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->senderIdentitiesPath($options['id']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get sender identity usage data.
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function usedBy(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('The unique id of the sender identity is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->senderIdentitiesPath($options['id'], ['used_by']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }
}
