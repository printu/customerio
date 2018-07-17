<?php

namespace Customerio\Endpoint;

class Messages extends Base
{
    /**
     * List metadata about messages
     * @see https://learn.customer.io/api/#apibeta-apimessagesmessages_list
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->messagesPath();
        return $this->client->get($path, $options);
    }

    /**
     * Get metadata about messages
     * @see https://learn.customer.io/api/#apibeta-apimessagesmessages_get
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Message id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->messagesPath($options['id']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }
}
