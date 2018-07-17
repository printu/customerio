<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Campaigns;
use PHPUnit\Framework\TestCase;

class CampaignsTest extends TestCase
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

    public function testCampaignGet()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->get([
            'id' => 1,
        ]));
    }

    public function testCampaignGetTriggeredMetrics()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->metrics([
            'id' => 1,
            'trigger_id' => 1,
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\RequestException
     */
    public function testCampaignGetMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->get([
        ]));
    }

    public function testCampaignSearch()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->search([
        ]));
    }

    public function testCampaignGetMetrics()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->metrics([
            'id' => 1,
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\RequestException
     */
    public function testCampaignGetMetricsMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->metrics([
        ]));
    }

    public function testCampaignGetTriggers()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->triggers([
            'id' => 1,
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\RequestException
     */
    public function testCampaignGetTriggersMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->triggers([
        ]));
    }

    public function testCampaignGetMessages()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->messages([
            'id' => 1,
        ]));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\RequestException
     */
    public function testCampaignGetMessagesMissingId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('get')->willReturn('foo');
        $campaigns = new Campaigns($stub);
        $this->assertEquals('foo', $campaigns->messages([
        ]));
    }
}
