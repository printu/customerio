<?php

namespace Customerio\Tests;

use Customerio\Endpoint\MessageTemplates;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class MessageTemplatesTest extends TestCase
{
    public function testExportsGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $template = new MessageTemplates($stub);
        $this->assertEquals('foo', $template->get([
            'id' => 1
        ]));
    }

    public function testExportsGetMetrics()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $template = new MessageTemplates($stub);
        $this->assertEquals('foo', $template->metrics([
            'id' => 1
        ]));
    }

    public function testExportsGetMissingId()
    {
        $this->expectException(RequestException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $template = new MessageTemplates($stub);
        $this->assertEquals('foo', $template->get([
        ]));
    }

    public function testExportsGetMetricsMissingId()
    {
        $this->expectException(RequestException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $template = new MessageTemplates($stub);
        $this->assertEquals('foo', $template->metrics([
        ]));
    }
}
