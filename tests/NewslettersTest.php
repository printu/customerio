<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Newsletters;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class NewslettersTest extends TestCase
{
    public function testNewslettersSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->search([
        ]));
    }

    public function testNewslettersGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->get([
            'id' => 1
        ]));
    }

    public function testNewslettersGetMetrics()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->metrics([
            'id' => 1
        ]));
    }

    public function testNewslettersGeMessages()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->messages([
            'id' => 1
        ]));
    }

    public function testNewslettersGetMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->get([
        ]));
    }

    public function testNewslettersGetMetricsMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->metrics([
        ]));
    }

    public function testNewslettersGeMessagesMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->messages([
        ]));
    }
}
