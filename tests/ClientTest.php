<?php

namespace Customerio\Tests;

use Customerio\Exception\CustomerioException;
use Customerio\Exception\ServerErrorResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Subscriber\History;

/**
 * Class ClientTest
 *
 * @categoty Tests
 * @package Customerio
 * @subpackage Tests
 */
class ClientTest extends AbstractTest
{
    public function testCustomConfig()
    {
        $config = [
            'http_client' => new Client(),
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

    public function testServerMalformedJsonResponse()
    {
        $history = new History();
        $client = $this->createClient('jsonError', $history);

        try {
            $client->addCustomer([
                'id' => 45,
                'email' => 'test@example.com'
            ]);
        } catch (CustomerioException $e) {
            $this->assertSame($e->getResponse()->getStatusCode(), 502);
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

    public function testUnsuccessfulResponse()
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
}
