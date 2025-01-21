<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Track;
use PHPUnit\Framework\TestCase;

class TrackTest extends TestCase
{
    public function testSingleEntity()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $events = new Track($stub);
        $this->assertEquals('foo', $events->entity([
            'type'        => 'person',
            'identifiers' => [
                'id' => '12345',
            ],
            'action'      => 'event',
            'name'        => 'test new event',
        ]));
    }

    public function testBatchEntity()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $events = new Track($stub);
        $this->assertEquals('foo', $events->batch(
            ["batch" => [[
                'type'        => 'person',
                'identifiers' => [
                    'id' => 'ziT8aeAcSdYBKvYCzx',
                ],
                'action'      => 'event',
                'name'        => 'test new event',
            ],
            [
                'type'        => 'person',
                'identifiers' => [
                    'id' => 'ziT8aeAcSdYBKvYCzx',
                ],
                'action'      => 'event',
                'name'        => 'test new event 2',
            ]]]
        ));
    }
}
