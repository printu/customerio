<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Track extends Base
{
    /**
     * Make a single request
     * @see https://docs.customer.io/api/track/#operation/entity
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function entity(array $options)
    {
        if (!isset($options['type'])) {
            $this->mockException('Operation type is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['action'])) {
            $this->mockException('An event action is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['identifiers'])) {
            $this->mockException('Object identifiers is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->generatePath('entity');
        $options['endpoint'] = $this->client->getRegion()->trackUri('v2');

        return $this->client->post($path, $options);
    }

    /**
     * Send multiple requests
     * @see https://docs.customer.io/api/track/#operation/batch
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function batch(array $options)
    {
        if (!isset($options['batch'])) {
            $this->mockException('Batch paremeter is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->generatePath('batch');
        $options['endpoint'] = $this->client->getRegion()->trackUri('v2');

        return $this->client->post($path, $options);
    }
}
