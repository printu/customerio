<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Page;

class PageTest extends \PHPUnit_Framework_TestCase
{
    public function testEventAnonymous()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Page($stub);
        $this->assertEquals('foo', $page->view([
            'id' => 'XYZ',
            'url' => 'ZXY'
        ]));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEventIdException()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Page($stub);
        $this->assertEquals('foo', $page->view([]));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEventUrlException()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Page($stub);
        $this->assertEquals('foo', $page->view([
            'id' => 123
        ]));
    }
}
