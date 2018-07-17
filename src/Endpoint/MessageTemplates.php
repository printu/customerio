<?php

namespace Customerio\Endpoint;

class MessageTemplates extends Base
{
    /**
     * Get message template data
     * @see https://learn.customer.io/api/#apibeta-apimsg_templatesmsg_templates_get
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Message Template id is required!', 'GET');
        }

        $path = $this->messagesTemplatesPath($options['id']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get message template metrics
     * @see https://learn.customer.io/api/#apibeta-apimsg_templatesmsg_templates_get_metrics
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function metrics(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Message Template id is required!', 'GET');
        }

        $path = $this->messagesTemplatesPath($options['id'], ['metrics']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }
}
