<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Campaigns;

class CampaignsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCampaignTrigger()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->trigger(['id' => 1]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\GuzzleException
     */
    public function testCampaignTriggerIdMissing()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->trigger([]));
    }
}
