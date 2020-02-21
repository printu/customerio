<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Segments;
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSegmentsCreateMissingName()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testExportsGetMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->get([
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testExportsGetUsedByMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->usedBy([
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testExportsGetCustomerCountMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->customerCount([
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testExportsGetMembershipMissingId()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSegmentsDeleteMissingId()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSegmentsAddCustomersMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->addCustomers([
            'ids' => []
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSegmentsAddCustomersMissingIds()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSegmentsRemoveCustomersMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->removeCustomers([
            'ids' => []
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSegmentsRemoveCustomersMissingIds()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $segments = new Segments($stub);
        $this->assertEquals('foo', $segments->removeCustomers([
            'id' => 10,
            'ids' => 'asdsa'
        ]));
    }
}
