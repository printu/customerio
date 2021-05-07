<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Segments extends Base
{

    /**
     * Create manual segment
     * @see https://customer.io/docs/api/#apibeta-apisegmentssegment_create
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function create(array $options)
    {
        if (!isset($options['name'])) {
            $this->mockException('Segments name is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath();
        $json = ['segment' => $options];
        $json['endpoint'] = $this->client->getRegion()->betaUri();

        return $this->client->post($path, $json);
    }

    /**
     * List segments
     * @see https://learn.customer.io/api/#apibeta-apisegmentssegments_list
     * @param array $options
     * @return mixed
     * @throws GuzzleException
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
     * @throws GuzzleException
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
     * @throws GuzzleException
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
     * @throws GuzzleException
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
     * @throws GuzzleException
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
     * @throws GuzzleException
     */
    public function delete(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'DELETE');
        } // @codeCoverageIgnore

        $path = $this->segmentsPath($options['id']);
        unset($options['id']);
        $options['endpoint'] = $this->client->getRegion()->betaUri();

        return $this->client->delete($path, $options);
    }

    /**
     * Add people to a manual segment
     * @see https://customer.io/docs/api/#apitracksegmentsadd_customers
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function addCustomers(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['ids']) || !is_array($options['ids'])) {
            $this->mockException('Customer ids are required!', 'POST');
        } // @codeCoverageIgnores

        $path = $this->segmentsPath($options['id'], ['add_customers']);
        unset($options['id']);

        return $this->client->post($path, $options);
    }

    /**
     * Remove people from a manual segment
     * @see https://customer.io/docs/api/#apitracksegmentsremove_customers
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function removeCustomers(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Segments id is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['ids']) || !is_array($options['ids'])) {
            $this->mockException('Customer ids are required!', 'POST');
        } // @codeCoverageIgnores

        $path = $this->segmentsPath($options['id'], ['remove_customers']);
        unset($options['id']);

        return $this->client->post($path, $options);
    }
}
