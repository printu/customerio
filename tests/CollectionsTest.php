<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Collections;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class CollectionsTest extends TestCase
{

    public function testCollectionsSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->search([
        ]));
    }

    public function testCollectionGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->get([
            'id' => 1,
        ]));
    }

    public function testCollectionGetMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->get([
        ]));
    }

    public function testCollectionCreate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->create([
            'name' => 'example collection',
            'data' => [
                [
                    'name' => 'example',
                ],
            ],
        ]));
    }

    public function testCollectionCreateMissingData()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->create([
            'name' => 'example collection',
        ]));
    }

    public function testCollectionCreateMissinName()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->create([
            'url' => 'https://example.com/file.json',
        ]));
    }

    public function testCollectionDelete()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->delete([
            'collection_id' => 1,
        ]));
    }

    public function testCollectionDeleteIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('delete')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->delete([
            'id' => 1,
        ]));
    }

    public function testCollectionUpdate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->update([
            'collection_id' => 1,
        ]));
    }

    public function testCollectionUpdateIdMissing()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->update([
            'name' => 'example name',
        ]));
    }

    public function testCollectionContent()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->content([
            'collection_id' => 1
        ]));
    }

    public function testCollectionContentMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->content([
            'id' => 1,
        ]));
    }

    public function testCollectionContentUpdate()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->updateContent([
            'collection_id' => 1,
            'data' => [
                'x',
                'y',
            ],
        ]));
    }

    public function testCollectionContentUpdateMissingId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->updateContent([
            'data' => [
                'x',
                'y',
            ],
        ]));
    }

    public function testCollectionContentUpdateMissingData()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('put')->willReturn('foo');
        $collections = new Collections($stub);
        $this->assertEquals('foo', $collections->updateContent([
            'collection_id' => 1,
        ]));
    }
}
