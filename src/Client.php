<?php

namespace Customerio;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Collection;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber;

/**
 * Client used to interact with **Customer.io RESTful API**
 *
 * @method array addCustomer(array $config = [])
 * @method array updateCustomer(array $config = [])
 * @method array deleteCustomer(array $config = [])
 */
class Client extends GuzzleClient
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // Apply some defaults.
        $config = Collection::fromConfig(
            $config,
            ['max_retries' => 3, 'description_path' => __DIR__ . '/services/description.php',],
            ['api_key', 'site_id']
        );

        // Create the client.
        $this->handleHttpClientOptions($config);
        $this->handleDescriptionOptions($config);

        parent::__construct(
            $config['http_client'],
            $config['description'],
            $config->toArray()
        );

        // Ensure that the credentials are set.
        $this->handleCredentialsOptions($config);

        // Ensure that ApiVersion is set.
        $this->setConfig('defaults/ApiVersion', $this->getDescription()->getApiVersion());
    }

    /**
     * @param Collection $config
     */
    private function handleHttpClientOptions(Collection $config)
    {
        if ($config['http_client']) {
            // HTTP client was injected
            return;
        }
        $client = new HttpClient($config['http_client_options'] ?: []);
        // Attach request retry logic
        $client->getEmitter()->attach(new RetrySubscriber([
            'max' => $config['max_retries'],
            'filter' => RetrySubscriber::createChainFilter([
                RetrySubscriber::createStatusFilter(),
                RetrySubscriber::createCurlFilter(),
            ]),
        ]));
        $config['http_client'] = $client;
    }

    /**
     * @param Collection $config
     *
     * @throws \InvalidArgumentException
     */
    private function handleDescriptionOptions(Collection $config)
    {
        if ($config['description']) {
            // Service description was injected
            return;
        }
        // Load service description data
        $path = $config['description_path'];
        /** @noinspection PhpIncludeInspection */
        $data = file_exists($path) ? include $path : null;
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Invalid description');
        }
        $config['description'] = new Description($data);
    }

    /**
     * @param Collection $config
     */
    private function handleCredentialsOptions(Collection $config)
    {
        if (!$this->getHttpClient()->getDefaultOption('auth')) {
            $this->getHttpClient()->setDefaultOption('auth', [
                $config['site_id'],
                $config['api_key'],
            ]);
        }
    }
}
