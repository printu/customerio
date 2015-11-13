<?php

namespace Customerio\Tests;

use Customerio\Client;
use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Subscriber\Mock;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $mock
     * @param History $history
     * @param array $config
     * @return Client
     */
    protected function createClient($mock, History $history, $config = [])
    {
        $path = sprintf('%s/fixtures/%s', __DIR__, $mock);

        $config['api_key'] = 'key';
        $config['site_id'] = 'site_id';

        $client = new Client($config);
        $httpClient = $client->getHttpClient();
        $mock = new Mock([
            $path
        ]);

        $httpClient->getEmitter()->attach($mock);
        $httpClient->getEmitter()->attach($history);

        return $client;
    }
}
