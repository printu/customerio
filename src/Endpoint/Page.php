<?php

namespace Customerio\Endpoint;

class Page extends Base
{
    /**
     * Add page view
     * @see https://customer.io/docs/pageviews.html
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function view(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('User id is required!', 'POST');
        }

        if (!isset($options['url'])) {
            $this->mockException('URL is required!', 'POST');
        }

        $options['name'] = $options['url'];
        unset($options['url']);

        $path = $this->customerPath($options['id']);

        return $this->client->post($path."/events", array_merge(["type" => "page"], $options));
    }
}
