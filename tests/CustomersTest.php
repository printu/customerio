<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Customers;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class CustomersTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testUserCreate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1,
            'email' => 'test@customer.io',
            'plan' => 'free',
        ]));
    }

    public function testUserCreateIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->add([
            'email' => 'test@customer.io',
        ]));
    }

    public function testUserCreateEmailMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1,
        ]));
    }

    /**
     * @throws GuzzleException
     */
    public function testUserUpdate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->update([
            'id' => 1,
            'email' => 'test@customer.io',
        ]));
    }

    /**
     * @throws GuzzleException
     */
    public function testUserDelete()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->delete([
            'id' => 1,
        ]));
    }

    public function testUserDeleteIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->delete([]));
    }

    /**
     * @throws GuzzleException
     */
    public function testUserEvent()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->event([
            'id' => 1,
            'name' => 'testing-123',
        ]));
    }

    public function testCustomerEventIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->event([
            'name' => 'testing-123',
        ]));
    }

    public function testCustomerEventNameMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->event([
            'id' => 1,
        ]));
    }

    public function testCustomerGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->get([
            'email' => 'user@example.com'
        ]));
    }

    public function testCustomerGetEmailMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->get([
        ]));
    }

    public function testCustomerSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->search([
            'filter' => []
        ]));
    }

    public function testCustomerSearchFilterMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->search([
            'start' => 1
        ]));
    }

    public function testCustomerGetAttributes()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->attributes([
            'id' => 1
        ]));
    }

    public function testCustomerGetAttributesEmailMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->attributes([
        ]));
    }

    public function testCustomerGetSegments()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->segments([
            'id' => 1
        ]));
    }

    public function testCustomerGetSegmentsEmailMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->segments([
        ]));
    }

    public function testCustomerGetMessages()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->messages([
            'id' => 1
        ]));
    }

    public function testCustomerGetMessagesEmailMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->messages([
        ]));
    }

    public function testCustomerGetActivities()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->activities([
            'id' => 1
        ]));
    }

    public function testCustomerGetActivitiesIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->activities([
        ]));
    }

    public function testCustomerSuppress()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->suppress([
            'id' => 1
        ]));
    }

    public function testCustomerSuppressIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->suppress([
        ]));
    }

    public function testCustomerUnSuppress()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->unsuppress([
            'id' => 1
        ]));
    }

    public function testCustomerUnSuppressIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->unsuppress([
        ]));
    }
}
