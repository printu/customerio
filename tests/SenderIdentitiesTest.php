<?php

namespace Customerio\Tests;

use Customerio\Endpoint\SenderIdentities;
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSenderIdentitieGetIdMissing()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testSenderIdentitieGetUsedByIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $sender = new SenderIdentities($stub);
        $this->assertEquals('foo', $sender->usedBy([
        ]));
    }
}
