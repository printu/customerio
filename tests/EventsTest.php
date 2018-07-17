<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Events;
use PHPUnit\Framework\TestCase;

class EventsTest extends TestCase
{
    public function testEventAnonymous()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $events = new Events($stub);
        $this->assertEquals('foo', $events->anonymous([
            'name' => 'test-event'
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testEventAnonymousException()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $events = new Events($stub);
        $this->assertEquals('foo', $events->anonymous([]));
    }
}
