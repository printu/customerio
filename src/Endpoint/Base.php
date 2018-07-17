<?php

namespace Customerio\Endpoint;

use Customerio\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Base
{
    /** @var Client */
    protected $client;

    /**
     * Base constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param null $id
     * @param array $extra
     * @return string
     */
    protected function customerPath($id = null, array $extra = [])
    {
        return $this->generatePath('customers', $id, $extra);
    }

    /**
     * @param null $id
     * @param array $extra
     * @return string
     */
    protected function campaignPath($id = null, array $extra = [])
    {
        return $this->generatePath('campaigns', $id, $extra);
    }

    /**
     * @param null $id
     * @param array $extra
     * @return string
     */
    protected function messagesPath($id = null, array $extra = [])
    {
        return $this->generatePath('messages', $id, $extra);
    }

    /**
     * @param $id
     * @param array $extra
     * @return string
     */
    protected function messagesTemplatesPath($id, array $extra = [])
    {
        return $this->generatePath('msg_templates', $id, $extra);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function newslettersPath($id = null, array $extra = [])
    {
        return $this->generatePath('newsletters', $id, $extra);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function segmentsPath($id = null, array $extra = [])
    {
        return $this->generatePath('segments', $id, $extra);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function exportsPath($id = null, array $extra = [])
    {
        return $this->generatePath('exports', $id, $extra);
    }

    /**
     * @param $message
     * @param $method
     */
    protected function mockException($message, $method)
    {
        throw new RequestException($message, (new Request($method, '/')));
    }

    /**
     * @param $prefix
     * @param null $id
     * @param array $extra
     * @return string
     */
    private function generatePath($prefix, $id = null, array $extra = [])
    {
        $path = [
            $prefix,
        ];

        if (!empty($id)) {
            $path[] = (int)$id;
        }

        if (!empty($extra)) {
            $path = array_merge($path, $extra);
        }

        return implode('/', $path);
    }
}
