<?php

namespace Customerio\Tests;

use Customerio\Endpoint\Send;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class SendTest extends TestCase
{
    public function testSendEmailWithId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->email([
            'transactional_message_id' => 2,
            'to' => 'test@example.com',
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendEmailWithBody()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->email([
            'body' => 'test body',
            'subject' => 'test subject',
            'from' => 'test@example.com',
            'to' => 'test@example.com',
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendEmailWithIdMissingToEmail()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->email([
            'transactional_message_id' => 2,
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendEmailWithIMissingIdentifiers()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->email([
            'transactional_message_id' => 2,
            'to' => 'test@example.com',
        ]));
    }

    public function testSendEmailWithBodyMissingBody()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->email([
            'subject' => 'test subject',
            'from' => 'test@example.com',
            'to' => 'test@example.com',
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendEmailWithBodyMissingSubject()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->email([
            'body' => 'test body',
            'from' => 'test@example.com',
            'to' => 'test@example.com',
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendEmailWithBodyMissingFrom()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->email([
            'body' => 'test body',
            'subject' => 'test subject',
            'to' => 'test@example.com',
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendSmsWithId()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->sms([
            'transactional_message_id' => 2,
            'to' => '+15551234567',
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendSmsWithMessageData()
    {
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->sms([
            'transactional_message_id' => 2,
            'to' => '+15551234567',
            'identifiers' => [
                'id' => 12,
            ],
            'message_data' => [
                'name' => 'John Doe',
            ],
        ]));
    }

    public function testSendSmsMissingTransactionalMessageId()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->sms([
            'to' => '+15551234567',
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendSmsMissingTo()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->sms([
            'transactional_message_id' => 2,
            'identifiers' => [
                'id' => 12,
            ],
        ]));
    }

    public function testSendSmsMissingIdentifiers()
    {
        $this->expectException(GuzzleException::class);
        $stub = $this->getMockBuilder('Customerio\Client')->disableOriginalConstructor()->getMock();
        $stub->method('post')->willReturn('foo');
        $page = new Send($stub);
        $this->assertEquals('foo', $page->sms([
            'transactional_message_id' => 2,
            'to' => '+15551234567',
        ]));
    }
}
