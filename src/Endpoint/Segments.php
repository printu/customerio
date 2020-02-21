<?php

namespace Customerio\Endpoint;

use Customerio\Client;

class Segments extends Base
{

    /**
     * Create manual segment
     * @see https://customer.io/docs/api/#apibeta-apisegmentssegment_create
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $options)
    {
        if (!isset($options['name'])) {
            $this->mockException('Segments name is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath();
        $json = ['segment' => $options];
        $json['endpoint'] = Client::API_ENDPOINT_BETA;

        return $this->client->post($path, $json);
    }

    /**
     * List segments
     * @see https://learn.customer.io/api/#apibeta-apisegmentssegments_list
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->segmentsPath();

        return $this->client->get($path, $options);
    }

    /**
     * Get segment data
     * @see https://learn.customer.io/api/#apibeta-apisegmentssegments_get
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath($options['id']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get dependencies of a segment
     * @see https://learn.customer.io/api/#apibeta-apisegmentssegments_used_by
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function usedBy(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath($options['id'], ['used_by']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get number of customers in a segment
     * @see https://learn.customer.io/api/#apibeta-apisegmentssegments_customer_count
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function customerCount(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath($options['id'], ['customer_count']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get the membership of a segment
     * @see https://learn.customer.io/api/#apibeta-apisegmentssegments_customer_count
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function membership(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath($options['id'], ['membership']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Delete an existing manual segment by id
     * @see https://customer.io/docs/api/#apibeta-apisegmentssegment_delete
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'DELETE');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath($options['id']);
        unset($options['id']);
        $options['endpoint'] = Client::API_ENDPOINT_BETA;

        return $this->client->delete($path, $options);
    }
}
