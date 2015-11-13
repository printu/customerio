<?php

namespace Customerio;

use Customerio\Exception\CustomerioException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Collection;
use GuzzleHttp\Command\Event\ProcessEvent;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber;

/**
 * Client used to interact with **Customer.io RESTful API**
 *
 * @method array addCustomer(array $config = [])
 * @method array updateCustomer(array $config = [])
 * @method array deleteCustomer(array $config = [])
 * @method array addEvent(array $config = [])
 */
class Client extends GuzzleClient
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $defaultConfig = [
            'max_retries' => 3,
            'description_path' => __DIR__ . '/services/description.php'
        ];

        // Apply some defaults.
        $config = Collection::fromConfig(
            $config,
            $defaultConfig,
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

        $this->handleErrors();

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

    /**
     * Overrides the error handling in Guzzle so that when errors are encountered we throw
     * Customerio errors, not Guzzle ones.
     *
     */
    private function handleErrors()
    {
        $emitter = $this->getEmitter();
        $emitter->on('process', function (ProcessEvent $e) {
            if (!$e->getException()) {
                return;
            }
            // Stop other events from firing when you override 401 responses
            $e->stopPropagation();
            if ($e->getResponse()->getStatusCode() >= 400 && $e->getResponse()->getStatusCode() < 600) {
                $e = CustomerioException::factory($e->getRequest(), $e->getResponse(), $e);
                throw $e;
            }
        });
    }
}
