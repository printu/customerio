<?php

namespace Customerio\Tests;

use Customerio\Client;
use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Subscriber\Mock;

/**
 * Class ClientTest
 *
 * @categoty Tests
 * @package Customerio
 * @subpackage Tests
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateCustomer()
    {
        $history = new History();
        $client = $this->createClient('addCustomer', $history);
        $response = $client->addCustomer([
            'id' => 45,
            'email' => 'test@example.com'
        ]);

        $this->assertSame($response['statusCode'], 200);
        $this->assertSame('https://track.customer.io/api/v1/customers/45', $history->getLastRequest()->getUrl());
        $this->assertSame('PUT', $history->getLastRequest()->getMethod());
    }

    /**
     * @param $mock
     * @param History $history
     * @return Client
     */
    private function createClient($mock, History $history)
    {
        $path = sprintf('%s/fixtures/%s', __DIR__, $mock);
        print_r($path);
        $client = new Client(['api_key' => 'key', 'site_id' => 'site_id']);
        $httpClient = $client->getHttpClient();
        $mock = new Mock([
            $path
        ]);

        $httpClient->getEmitter()->attach($mock);
        $httpClient->getEmitter()->attach($history);

        return $client;
    }
}
