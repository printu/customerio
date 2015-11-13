<?php

namespace Customerio\Tests;

use GuzzleHttp\Subscriber\History;

class CustomersTest extends AbstractTest
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
}
