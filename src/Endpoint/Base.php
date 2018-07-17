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
     * @param int $customerId
     * @return string
     */
    protected function customerPath($customerId)
    {
        return "customers/".$customerId;
    }

    /**
     * @param int $campaignId
     * @return string
     */
    protected function campaignPath($campaignId)
    {
        return "campaigns/".$campaignId;
    }

    /**
     * @param string $messageId
     * @return string
     */
    protected function messagesPath($messageId = null)
    {
        $path = [
            'messages'
        ];

        if (!empty($messageId)) {
            $path[] = $messageId;
        }

        return implode('/', $path);
    }

    /**
     * @param int $messageId
     * @param array $extra
     * @return string
     */
    protected function messagesTemplatesPath($messageId, $extra = [])
    {
        $path = [
            'msg_templates',
            (int)$messageId
        ];

        if (!empty($extra)) {
            $path = array_merge($path, $extra);
        }

        return implode('/', $path);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function newslettersPath($id = null, $extra = [])
    {
        $path = [
            'newsletters',
        ];

        if (!empty($id)) {
            $path[] = (int)$id;
        }

        if (!empty($extra)) {
            $path = array_merge($path, $extra);
        }

        return implode('/', $path);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function segmentsPath($id = null, $extra = [])
    {
        $path = [
            'segments',
        ];

        if (!empty($id)) {
            $path[] = (int)$id;
        }

        if (!empty($extra)) {
            $path = array_merge($path, $extra);
        }

        return implode('/', $path);
    }

    /**
     * @param $message
     * @param $method
     */
    protected function mockException($message, $method)
    {
        throw new RequestException($message, (new Request($method, '/')));
    }
}
