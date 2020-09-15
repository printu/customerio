<?php

namespace Customerio\Tests;

use Customerio\Endpoint\SenderIdentities;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class SenderIdentitiesTest extends TestCase
{
    public function testSenderIdentitiesSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $sender = new SenderIdentities($stub);
        $this->assertEquals('foo', $sender->search([]));
    }

    public function testSenderIdentitieGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $sender = new SenderIdentities($stub);
        $this->assertEquals('foo', $sender->get([
            'id' => 1
        ]));
    }

    public function testSenderIdentitieGetIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $sender = new SenderIdentities($stub);
        $this->assertEquals('foo', $sender->get([
        ]));
    }

    public function testSenderIdentitieGetUsedBy()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $sender = new SenderIdentities($stub);
        $this->assertEquals('foo', $sender->usedBy([
            'id' => 1
        ]));
    }

    public function testSenderIdentitieGetUsedByIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $sender = new SenderIdentities($stub);
        $this->assertEquals('foo', $sender->usedBy([
        ]));
    }
}
