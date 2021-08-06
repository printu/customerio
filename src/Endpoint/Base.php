<?php

namespace Customerio\Endpoint;

use Customerio\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\RequestExceptionInterface;

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
    protected function customerPath($id = null, array $extra = []): string
    {
        return $this->generatePath('customers', $id, $extra);
    }

    /**
     * @param null $id
     * @param array $extra
     * @return string
     */
    protected function campaignPath($id = null, array $extra = []): string
    {
        return $this->generatePath('campaigns', $id, $extra);
    }

    /**
     * @param null $id
     * @param array $extra
     * @return string
     */
    protected function messagesPath($id = null, array $extra = []): string
    {
        return $this->generatePath('messages', $id, $extra);
    }

    /**
     * @param $id
     * @param array $extra
     * @return string
     */
    protected function messagesTemplatesPath($id, array $extra = []): string
    {
        return $this->generatePath('msg_templates', $id, $extra);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function newslettersPath($id = null, array $extra = []): string
    {
        return $this->generatePath('newsletters', $id, $extra);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function segmentsPath($id = null, array $extra = []): string
    {
        return $this->generatePath('segments', $id, $extra);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function exportsPath($id = null, array $extra = []): string
    {
        return $this->generatePath('exports', $id, $extra);
    }

    /**
     * @param int $id
     * @param array $extra
     * @return string
     */
    protected function activitiesPath($id = null, array $extra = []): string
    {
        return $this->generatePath('activities', $id, $extra);
    }

    /**
     * @param int|null $id
     * @param array $extras
     * @return string
     */
    protected function collectionsPath(?int $id = null, array $extras = []): string
    {
        return $this->generatePath('collections', $id, $extras);
    }

    /**
     * @param null $id
     * @param array $extra
     * @return string
     */
    protected function senderIdentitiesPath($id = null, array $extra = []): string
    {
        return $this->generatePath('sender_identities', $id, $extra);
    }

    /**
     * @param $message
     * @param $method
     */
    protected function mockException($message, $method): RequestExceptionInterface
    {
        throw new RequestException($message, (new Request($method, '/')));
    }

    /**
     * @param $prefix
     * @param null $id
     * @param array $extra
     * @return string
     */
    private function generatePath($prefix, $id = null, array $extra = []): string
    {
        $path = [
            $prefix,
        ];

        if (!empty($id)) {
            $path[] = (string)$id;
        }

        if (!empty($extra)) {
            $path = array_merge($path, $extra);
        }

        return implode('/', $path);
    }
}
