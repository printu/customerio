<?php

namespace Customerio\Endpoint;

class Customers extends Base
{
    /**
     * Register customer event
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function event(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('User id is required!', 'POST');
        }

        if (!isset($options['name'])) {
            $this->mockException('Name is required!', 'POST');
        }

        $path = $this->customerPath($options['id']);

        return $this->client->post($path."/events", $options);
    }

    /**
     * Add new customer
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('User id is required!', 'PUT');
        }

        if (!isset($options['email'])) {
            $this->mockException('Email is required!', 'PUT');
        }

        $path = $this->customerPath($options['id']);
        $data = array_diff_key($options, array_flip((array) ['id', 'email']));

        if ($data && !empty($data)) {
            $options['data'] = $data;
        }

        return $this->client->put($path, $options);
    }

    /**
     * Delete customer
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('User id is required!', 'DELETE');
        }

        $path = $this->customerPath($options['id']);

        return $this->client->delete($path, []);
    }

    /**
     * Update new customer
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(array $options)
    {
        return $this->add($options);
    }
}
