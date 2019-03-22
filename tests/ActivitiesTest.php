<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Activities;
use PHPUnit\Framework\TestCase;

class ActivitiesTest extends TestCase
{
    public function testActivitiesSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $activities = new Activities($stub);
        $this->assertEquals('foo', $activities->search([]));
    }
}
