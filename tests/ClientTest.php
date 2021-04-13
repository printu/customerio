<?php

namespace Customerio\Tests;

use Customerio\Client as CustomerIoClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testBasicClient()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
        ]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new CustomerIoClient('u', 'p');
        $client->setAppAPIKey('t');
        $client->setSiteId('p');
        $client->setAssocResponse(false);
        $client->setClient($http_client);
        $client->customers->get([
            'email' => 'test@customer.io',
        ]);
        $client->customers->add([
            'id' => 10,
            'email' => 'test@customer.io',
        ]);
        $client->customers->event([
            'id' => 10,
            'name' => 'test-event',
            'endpoint' => CustomerIoClient::API_ENDPOINT,
        ]);
        $client->customers->delete([
            'id' => 10,
        ]);
        foreach ($container as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $auth = $request->getHeaders()['Authorization'][0];
            switch ($request->getUri()->getHost()) {
                case parse_url(CustomerIoClient::API_ENDPOINT_BETA, PHP_URL_HOST):
                case parse_url(CustomerIoClient::API_ENDPOINT, PHP_URL_HOST):
                    $this->assertTrue($auth == "Bearer t");
                    break;
                default:
                    $this->assertTrue($auth == "Basic cDp1");
            }
        }
    }

    public function testClientArrayResponse()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
        ]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new CustomerIoClient('u', 'p');
        $client->setAppAPIKey('t');
        $client->setAssocResponse(true);
        $client->setClient($http_client);

        $response = $client->customers->get([
            'email' => 'test@customer.io',
        ]);

        $this->assertIsArray($response);
    }

    public function testClientObjectResponse()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
        ]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new CustomerIoClient('u', 'p');
        $client->setAppAPIKey('t');
        $client->setClient($http_client);

        $response = $client->customers->get([
            'email' => 'test@customer.io',
        ]);

        $this->assertIsObject($response);
        $this->assertObjectHasAttribute('foo', $response);
    }

    public function testBasicClientNoAppKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
        ]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new CustomerIoClient('u', 'p');
        $client->setClient($http_client);
        $client->customers->get([
            'email' => 'test@customer.io',
        ]);
    }
}
