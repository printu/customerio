<?php

namespace Customerio\Tests;

use Customerio\Client as CustomerIoClient;
use Customerio\Region\InvalidRegionException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testBasicClientUs()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}"),
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
        $client->collection->content([
            'collection_id' => 1,
        ]);
        $client->customers->add([
            'id' => 10,
            'email' => 'test@customer.io',
        ]);
        $client->customers->event([
            'id' => 10,
            'name' => 'test-event',
            'endpoint' => $client->getRegion()->apiUri(),
        ]);
        $client->customers->delete([
            'id' => 10,
        ]);
        foreach ($container as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $auth = $request->getHeaders()['Authorization'][0];
            switch ($request->getUri()->getHost()) {
                case parse_url($client->getRegion()->apiUri(), PHP_URL_HOST):
                    $this->assertTrue($auth == "Bearer t");
                    break;
                default:
                    $this->assertTrue($auth == "Basic cDp1");
            }
        }
    }

    public function testBasicClientEu()
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
        $client->setRegion('eu');
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
            'endpoint' => $client->getRegion()->apiUri(),
        ]);
        $client->customers->delete([
            'id' => 10,
        ]);
        foreach ($container as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $auth = $request->getHeaders()['Authorization'][0];
            switch ($request->getUri()->getHost()) {
                case parse_url($client->getRegion()->apiUri(), PHP_URL_HOST):
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
        $this->assertTrue(property_exists($response, 'foo'));
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
        $client->setSiteId('1234');
        $client->customers->get([
            'email' => 'test@customer.io',
        ]);
    }

    public function testRegionEu()
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
        $client->setClient($http_client);
        $client->setSiteId('1234');
        $client->setAppAPIKey('t');
        $client->setRegion('eu');
        $response = $client->customers->get([
            'email' => 'test@customer.io',
        ]);
        $this->assertIsObject($response);
    }

    public function testRegionUnknown()
    {
        $this->expectException(InvalidRegionException::class);
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
        $client->setSiteId('1234');
        $client->setAppAPIKey('t');
        $client->setRegion('au');
        $response = $client->customers->get([
            'email' => 'test@customer.io',
        ]);
        $this->assertIsObject($response);
    }

    public function testRequestParams()
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
        $client->setSiteId('p');
        $client->setAssocResponse(false);
        $client->setClient($http_client);
        $client->setRegion('eu');
        $client->customers->search([
            'query' => [
                'limit' => 5,
            ],
            'filter' => [
                "attribute" => [
                    "field" => "email",
                    "operator" => "exists",
                ],
            ],
        ]);
        foreach ($container as $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $query = $request->getUri()->getQuery();

            $this->assertEquals('limit=5', $query);
        }
    }

    public function testObjectsRequests()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], "{\"types\":[{\"id\":\"1\"}]}"),
            new Response(200, ['Content-Type' => 'application/json'], "{\"identifiers\":[]}"),
            new Response(200, ['Content-Type' => 'application/json'], "{\"cio_relationships\":[]}"),
            new Response(200, ['Content-Type' => 'application/json'], "{\"object\":{\"attributes\":{}}}"),
        ]);
        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);
        $http_client = new Client(['handler' => $stack]);
        $client = new CustomerIoClient('u', 'p');
        $client->setAppAPIKey('test-key');
        $client->setClient($http_client);

        $client->objects->types();
        $client->objects->search([
            'object_type_id' => '1',
            'filter' => ['and' => []],
        ]);
        $client->objects->relationships([
            'object_type_id' => '1',
            'object_id' => 'acme',
            'limit' => 10,
        ]);
        $client->objects->attributes([
            'object_type_id' => '1',
            'object_id' => 'acme',
        ]);

        $this->assertCount(4, $container);

        $this->assertEquals('GET', $container[0]['request']->getMethod());
        $this->assertEquals('/v1/object_types', $container[0]['request']->getUri()->getPath());

        $this->assertEquals('POST', $container[1]['request']->getMethod());
        $this->assertEquals('/v1/objects', $container[1]['request']->getUri()->getPath());

        $this->assertEquals('GET', $container[2]['request']->getMethod());
        $this->assertEquals('/v1/objects/1/acme/relationships', $container[2]['request']->getUri()->getPath());
        $this->assertEquals('limit=10', $container[2]['request']->getUri()->getQuery());

        $this->assertEquals('GET', $container[3]['request']->getMethod());
        $this->assertEquals('/v1/objects/1/acme/attributes', $container[3]['request']->getUri()->getPath());
    }
}
