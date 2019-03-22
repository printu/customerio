<?php

namespace Customerio\Tests\Customers;

use Customerio\Endpoint\Customers\Devices;
use PHPUnit\Framework\TestCase;

class DevicesTest extends TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceCreate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1,
            'device_id' => 'hash',
            'platform' => 'ios',
            'last_used' => 1514764800
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceCreateIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'device_id' => 'hash',
            'platform' => 'ios',
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceCreateDeviceIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1234,
            'platform' => 'ios',
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceCreatePlatformMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1234,
            'device_id' => 'hash',
        ]));
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceUpdate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->update([
            'id' => 1,
            'device_id' => 'hash',
            'platform' => 'ios',
        ]));
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceDelete()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->delete([
            'id' => 1,
            'device_id' => 'hash',
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceDeleteIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->delete([
            'device_id' => 'hash',
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testDeviceDeleteDeviceIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->delete([
            'id' => 1,
        ]));
    }
}
