<?php

namespace Customerio\Tests;

use GuzzleHttp\Subscriber\History;

class EventsTest extends AbstractTest
{
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
}
