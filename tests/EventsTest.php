<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Events;

class EventsTest extends \PHPUnit_Framework_TestCase
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
     * @expectedException \InvalidArgumentException
     */
    public function testEventAnonymousException()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $events = new Events($stub);
        $this->assertEquals('foo', $events->anonymous([]));
    }
}
