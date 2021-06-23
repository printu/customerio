<?php

namespace Customerio\Endpoint\Customers;

use Customerio\Endpoint\Base;
use GuzzleHttp\Exception\GuzzleException;

class Devices extends Base
{
    /**
     * Add new device
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function add(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('User id is required!', 'PUT');
        } // @codeCoverageIgnore

        if (!isset($options['device']['id'])) {
            $this->mockException('Device id is required!', 'PUT');
        } // @codeCoverageIgnore

        if (!isset($options['device']['platform'])) {
            $this->mockException('Device platform is required!', 'PUT');
        } // @codeCoverageIgnore

        $path = $this->customerPath($options['id'], ['devices']);

        return $this->client->put($path, $options);
    }

    /**
     * Delete device
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function delete(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('User id is required!', 'DELETE');
        } // @codeCoverageIgnore

        if (!isset($options['device_id'])) {
            $this->mockException('Device id is required!', 'DELETE');
        } // @codeCoverageIgnore

        $path = $this->customerPath($options['id'], ['devices', $options['device_id']]);

        return $this->client->delete($path, []);
    }

    /**
     * Update device
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function update(array $options)
    {
        return $this->add($options);
    }
}
