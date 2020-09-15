<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Messages;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class MessagesTest extends TestCase
{
    public function testMessagesSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $messages = new Messages($stub);
        $this->assertEquals('foo', $messages->search([
        ]));
    }

    public function testMessagesGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $messages = new Messages($stub);
        $this->assertEquals('foo', $messages->get([
            'id' => 1
        ]));
    }

    public function testMessagesGetMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $messages = new Messages($stub);
        $this->assertEquals('foo', $messages->get([
        ]));
    }
}
