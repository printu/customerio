<?php

namespace Customerio\Tests;

use Customerio\Endpoint\MessageTemplates;
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

    /**
     * @expectedException \GuzzleHttp\Exception\RequestException
     */
    public function testExportsGetMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $template = new MessageTemplates($stub);
        $this->assertEquals('foo', $template->get([
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\RequestException
     */
    public function testExportsGetMetricsMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $template = new MessageTemplates($stub);
        $this->assertEquals('foo', $template->metrics([
        ]));
    }
}
