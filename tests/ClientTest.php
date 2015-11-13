<?php

namespace Customerio\Tests;

use Customerio\Client;
use GuzzleHttp\Command\Guzzle\Description;
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

    public function testUpdateCustomer()
    {
        $history = new History();
        $client = $this->createClient('updateCustomer', $history);
        $response = $client->updateCustomer([
            'id' => 45,
            'email' => 'test@example.com'
        ]);

        $this->assertSame($response['statusCode'], 200);
        $this->assertSame('https://track.customer.io/api/v1/customers/45', $history->getLastRequest()->getUrl());
        $this->assertSame('PUT', $history->getLastRequest()->getMethod());
    }

    public function testDeleteCustomer()
    {
        $history = new History();
        $client = $this->createClient('deleteCustomer', $history);
        $response = $client->deleteCustomer([
            'id' => 45
        ]);

        $this->assertSame($response['statusCode'], 200);
        $this->assertSame('https://track.customer.io/api/v1/customers/45', $history->getLastRequest()->getUrl());
        $this->assertSame('DELETE', $history->getLastRequest()->getMethod());
    }

    public function testCustomConfig()
    {
        $config = [
            'http_client' => new \GuzzleHttp\Client(),
            'description' => new Description([])
        ];

        $history = new History();
        $this->createClient('empty', $history, $config);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCustomDescriptionPath()
    {
        $config = [
            'description_path' => '/tmp/file_does_not_exists'
        ];

        $history = new History();
        $this->createClient('empty', $history, $config);
    }

    /**
     * @param $mock
     * @param History $history
     * @param array $config
     * @return Client
     */
    private function createClient($mock, History $history, $config = [])
    {
        $path = sprintf('%s/fixtures/%s', __DIR__, $mock);

        $config['api_key'] = 'key';
        $config['site_id'] = 'site_id';

        $client = new Client($config);
        $httpClient = $client->getHttpClient();
        $mock = new Mock([
            $path
        ]);

        $httpClient->getEmitter()->attach($mock);
        $httpClient->getEmitter()->attach($history);

        return $client;
    }
}
