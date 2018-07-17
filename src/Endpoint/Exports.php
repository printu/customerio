<?php

namespace Customerio\Endpoint;

class Exports extends Base
{
    /**
     * List exports
     * @see https://learn.customer.io/api/#apibeta-apiexportsexports_list
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->exportsPath();
        return $this->client->get($path, $options);
    }

    /**
     * Get export data
     * @see https://learn.customer.io/api/#apibeta-apiexportsexports_get
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Exports id is required!', 'GET');
        }

        $path = $this->exportsPath($options['id']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Download an export
     * @see https://learn.customer.io/api/#apibeta-apiexportsexports_download
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function download(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Exports id is required!', 'GET');
        }

        $path = $this->exportsPath($options['id'], ['download']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }
}
