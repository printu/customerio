<?php

namespace Customerio\Tests;

use Customerio\Client as CustomerIoClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicClient()
    {
        $mock = new MockHandler([
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
        $client->setClient($http_client);
        $client->customers->add([
            'id' => 10,
            'email' => 'test@customer.io',
        ]);
        $client->customers->event([
            'id' => 10,
            'name' => 'test-event',
        ]);
        $client->customers->delete([
            'id' => 10,
        ]);
        foreach ($container as $transaction) {
            /** @var \GuzzleHttp\Psr7\Request $request */
            $request = $transaction['request'];
            $basic = $request->getHeaders()['Authorization'][0];
            $this->assertTrue($basic == "Basic cDp1");
        }
    }
}
