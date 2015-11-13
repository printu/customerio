<?php

namespace Customerio\Tests;

use Customerio\Client;
use Customerio\Exception\CustomerioException;
use Customerio\Exception\ServerErrorResponseException;
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
        $client = $this->createClient('okResponse', $history);
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
        $client = $this->createClient('okResponse', $history);
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
        $client = $this->createClient('okResponse', $history);
        $response = $client->deleteCustomer([
            'id' => 45
        ]);

        $this->assertSame($response['statusCode'], 200);
        $this->assertSame('https://track.customer.io/api/v1/customers/45', $history->getLastRequest()->getUrl());
        $this->assertSame('DELETE', $history->getLastRequest()->getMethod());
    }

    public function testAddEvent()
    {
        $history = new History();
        $client = $this->createClient('okResponse', $history);
        $response = $client->addEvent([
            'id' => 45,
            'name' => 'test-event',
            'data' => [
                'test-data' => 1
            ]
        ]);

        $this->assertSame($response['statusCode'], 200);
        $this->assertSame('https://track.customer.io/api/v1/customers/45/events', $history->getLastRequest()->getUrl());
        $this->assertSame('POST', $history->getLastRequest()->getMethod());
    }

    public function testAnonymousEvent()
    {
        $history = new History();
        $client = $this->createClient('okResponse', $history);
        $response = $client->anonymousEvent([
            'name' => 'test-event-anonymous',
            'data' => [
                'test-data' => 1
            ]
        ]);

        $this->assertSame($response['statusCode'], 200);
        $this->assertSame('https://track.customer.io/api/v1/events', $history->getLastRequest()->getUrl());
        $this->assertSame('POST', $history->getLastRequest()->getMethod());
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

    public function testUnauthorizedRequest()
    {
        $history = new History();
        $client = $this->createClient('unauthorizedRequest', $history);

        try {
            $client->deleteCustomer([
                'id' => 45
            ]);
        } catch (CustomerioException $e) {
            $this->assertSame($e->getResponse()->getStatusCode(), 401);
            $this->assertArrayHasKey(0, $e->getErrors());
            $this->assertArrayHasKey('code', $e->getErrors()[0]);
            $this->assertSame(401, $e->getErrors()[0]['code']);
        }
    }

    public function testServerErrorResponse()
    {
        $history = new History();
        $client = $this->createClient('serverError', $history);

        try {
            $client->addCustomer([
                'id' => 45,
                'email' => 'test@example.com'
            ]);
        } catch (ServerErrorResponseException $e) {
            $this->assertSame($e->getResponse()->getStatusCode(), 502);
            $this->assertArrayHasKey(0, $e->getErrors());
            $this->assertArrayHasKey('code', $e->getErrors()[0]);
            $this->assertSame('service_unavailable', $e->getErrors()[0]['code']);
        }
    }

    public function testServiceUnaviable()
    {
        $history = new History();
        $client = $this->createClient('serviceUnavailable', $history);

        try {
            $client->addCustomer([
                'id' => 45,
                'email' => 'test@example.com'
            ]);
        } catch (CustomerioException $e) {
            $this->assertSame($e->getResponse()->getStatusCode(), 502);
        }
    }

    public function testUnsuccesfullResponse()
    {
        $history = new History();
        $client = $this->createClient('clientError', $history);

        try {
            $client->addCustomer([
                'id' => 45,
                'email' => 'test@example.com'
            ]);
        } catch (CustomerioException $e) {
            $this->assertSame($e->getResponse()->getStatusCode(), 404);
        }
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
