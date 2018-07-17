<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Newsletters;
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testNewslettersGetMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->get([
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testNewslettersGetMetricsMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->metrics([
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testNewslettersGeMessagesMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $newsletter = new Newsletters($stub);
        $this->assertEquals('foo', $newsletter->messages([
        ]));
    }
}
