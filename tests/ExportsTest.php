<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Exports;
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testExportsGetMissingId()
    {
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

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testExportsDownloaMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $export = new Exports($stub);
        $this->assertEquals('foo', $export->download([
        ]));
    }
}
