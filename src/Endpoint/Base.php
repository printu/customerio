<?php

namespace Customerio\Endpoint;

use Customerio\Client;

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
     * @param $customerId
     * @return string
     */
    protected function customerPath($customerId)
    {
        return "customers/".$customerId;
    }
}
