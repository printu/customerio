<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Page;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
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

    public function testEventIdException()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Page($stub);
        $this->assertEquals('foo', $page->view([]));
    }

    public function testEventUrlException()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Page($stub);
        $this->assertEquals('foo', $page->view([
            'id' => 123
        ]));
    }
}
