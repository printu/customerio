<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Customers;
use PHPUnit\Framework\TestCase;

class CustomersTest extends TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testUserCreateIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->add([
            'email' => 'test@customer.io',
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testUserCreateEmailMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1,
        ]));
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testUserDeleteIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->delete([]));
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerEventIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->event([
            'name' => 'testing-123',
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerEventNameMissing()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerGetEmailMissing()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerSearchFilterMissing()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerGetAttributesEmailMissing()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerGetSegmentsEmailMissing()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerGetMessagesEmailMissing()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCustomerGetActivitiesIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $customer = new Customers($stub);
        $this->assertEquals('foo', $customer->activities([
        ]));
    }
}
