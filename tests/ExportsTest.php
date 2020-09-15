<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Exports;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class ExportsTest extends TestCase
{
    public function testExportsSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $export = new Exports($stub);
        $this->assertEquals('foo', $export->search([
        ]));
    }

    public function testExportsGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $export = new Exports($stub);
        $this->assertEquals('foo', $export->get([
            'id' => 1
        ]));
    }

    public function testExportsGetMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $export = new Exports($stub);
        $this->assertEquals('foo', $export->get([
        ]));
    }

    public function testExportsDownload()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $export = new Exports($stub);
        $this->assertEquals('foo', $export->download([
            'id' => 1
        ]));
    }

    public function testExportsDownloaMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $export = new Exports($stub);
        $this->assertEquals('foo', $export->download([
        ]));
    }
}
