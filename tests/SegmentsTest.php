<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Segments;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class SegmentsTest extends TestCase
{
    public function testSegmentsCreate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->create([
            'name' => 'example'
        ]));
    }

    public function testSegmentsCreateMissingName()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->create([
        ]));
    }

    public function testExportsSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->search([
        ]));
    }

    public function testExportsGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->get([
            'id' => 1
        ]));
    }

    public function testExportsGetUsedBy()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->usedBy([
            'id' => 1
        ]));
    }

    public function testExportsGetCustomerCount()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->customerCount([
            'id' => 1
        ]));
    }

    public function testExportsGetMembership()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->membership([
            'id' => 1
        ]));
    }

    public function testExportsGetMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->get([
        ]));
    }

    public function testExportsGetUsedByMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->usedBy([
        ]));
    }

    public function testExportsGetCustomerCountMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->customerCount([
        ]));
    }

    public function testExportsGetMembershipMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->membership([
        ]));
    }

    public function testSegmentsDelete()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->delete([
            'id' => 10
        ]));
    }

    public function testSegmentsDeleteMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->delete([
        ]));
    }

    public function testSegmentsAddCustomers()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->addCustomers([
            'id' => 10,
            'ids' => []
        ]));
    }

    public function testSegmentsAddCustomersMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->addCustomers([
            'ids' => []
        ]));
    }

    public function testSegmentsAddCustomersMissingIds()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->addCustomers([
            'id' => 10,
            'ids' => 'asdsa'
        ]));
    }

    public function testSegmentsRemoveCustomers()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->removeCustomers([
            'id' => 10,
            'ids' => []
        ]));
    }

    public function testSegmentsRemoveCustomersMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->removeCustomers([
            'ids' => []
        ]));
    }

    public function testSegmentsRemoveCustomersMissingIds()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->removeCustomers([
            'id' => 10,
            'ids' => 'asdsa'
        ]));
    }
}
