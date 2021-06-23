<?php

namespace Customerio\Tests\Customers;

use Customerio\Endpoint\Customers\Devices;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class DevicesTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testDeviceCreate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1,
            'device' => [
                'id' => 'hash',
                'platform' => 'ios',
                'last_used' => 1514764800
            ]
        ]));
    }

    public function testDeviceCreateIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'device' => [
                'id' => 'hash',
                'platform' => 'ios',
            ]
        ]));
    }

    public function testDeviceCreateDeviceIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1234,
            'device' => [
                'platform' => 'ios',
            ]
        ]));
    }

    public function testDeviceCreatePlatformMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->add([
            'id' => 1234,
            'device' => [
                'id' => 'hash',
            ]
        ]));
    }

    /**
     * @throws GuzzleException
     */
    public function testDeviceUpdate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->update([
            'id' => 1,
            'device' => [
                'id' => 'hash',
                'platform' => 'ios',
            ]
        ]));
    }

    /**
     * @throws GuzzleException
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

    public function testDeviceDeleteIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->delete([
            'device_id' => 'hash',
        ]));
    }

    public function testDeviceDeleteDeviceIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $customer = new Devices($stub);
        $this->assertEquals('foo', $customer->delete([
            'id' => 1,
        ]));
    }
}
