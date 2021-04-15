<?php

declare(strict_types=1);

namespace Customerio;

use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const API_ENDPOINT_TRACK = 'https://track.customer.io/api/v1/';
    const API_ENDPOINT = 'https://api.customer.io/v1/';
    const API_ENDPOINT_BETA = 'https://beta-api.customer.io/v1/api/';

    /** @var BaseClient $httpClient */
    private $httpClient;

    /** @var string API key */
    protected $apiKey;

    /** @var string site ID */
    protected $siteId;

    /** @var string App API key */
    protected $appKey;

    /** @var bool Assoc mode for response */
    protected $assocResponse;

    /** @var Endpoint\Events $events */
    public $events;

    /** @var Endpoint\Customers $customers */
    public $customers;

    /** @var Endpoint\Page $page */
    public $page;

    /** @var Endpoint\Campaigns */
    public $campaigns;

    /** @var Endpoint\Messages */
    public $messages;

    /** @var Endpoint\MessageTemplates */
    public $messageTemplates;

    /** @var Endpoint\Newsletters */
    public $newsletters;

    /** @var Endpoint\Segments */
    public $segments;

    /** @var Endpoint\Exports */
    public $exports;

    /** @var Endpoint\Activities */
    public $activities;

    /** @var Endpoint\SenderIdentities */
    public $senderIdentities;

    /** @var Endpoint\Send */
    public $send;

    /**
     * Client constructor.
     * @param string $apiKey Api Key
     * @param string $siteId Site ID.
     */
    public function __construct(string $apiKey, string $siteId)
    {
        $this->setDefaultClient();
        $this->events = new Endpoint\Events($this);
        $this->customers = new Endpoint\Customers($this);
        $this->page = new Endpoint\Page($this);
        $this->campaigns = new Endpoint\Campaigns($this);
        $this->messages = new Endpoint\Messages($this);
        $this->messageTemplates = new Endpoint\MessageTemplates($this);
        $this->newsletters = new Endpoint\Newsletters($this);
        $this->segments = new Endpoint\Segments($this);
        $this->exports = new Endpoint\Exports($this);
        $this->activities = new Endpoint\Activities($this);
        $this->senderIdentities = new Endpoint\SenderIdentities($this);
        $this->send = new Endpoint\Send($this);

        $this->apiKey = $apiKey;
        $this->siteId = $siteId;
        $this->assocResponse = false;
    }

    /**
     * @param string $appKey
     */
    public function setAppAPIKey(string $appKey): void
    {
        $this->appKey = $appKey;
    }

    /**
     * @param string $siteId
     */
    public function setSiteId(string $siteId): void
    {
        $this->siteId = $siteId;
    }

    /**
     * @param bool $assoc
     */
    public function setAssocResponse(bool $assoc): void
    {
        $this->assocResponse = $assoc;
    }

    /**
     * Set default client
     */
    private function setDefaultClient(): void
    {
        $this->httpClient = new BaseClient();
    }

    /**
     * Sets GuzzleHttp client.
     * @param BaseClient $client
     */
    public function setClient(BaseClient $client): void
    {
        $this->httpClient = $client;
    }

    /**
     * Sends GET request to Customer.io API.
     * @param string $endpoint
     * @param array $params
     * @return mixed
     * @throws GuzzleException
     */
    public function get(string $endpoint, array $params = [])
    {
        $options = $this->getDefaultParams(self::API_ENDPOINT_BETA);
        if (!empty($params)) {
            $options['query'] = $params;
        }

        $response = $this->httpClient->request('GET', self::API_ENDPOINT_BETA.$endpoint, $options);

        return $this->handleResponse($response);
    }

    /**
     * Sends POST request to Customer.io API.
     * @param string $endpoint
     * @param array $json
     * @return mixed
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $json)
    {
        $response = $this->request('POST', $endpoint, $json);

        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Customer.io API.
     * @param string $endpoint
     * @param array $json
     * @return mixed
     * @throws GuzzleException
     */
    public function delete(string $endpoint, array $json)
    {
        $response = $this->request('DELETE', $endpoint, $json);

        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Customer.io API.
     * @param string $endpoint
     * @param array $json
     * @return mixed
     * @throws GuzzleException
     */
    public function put(string $endpoint, array $json)
    {
        $response = $this->request('PUT', $endpoint, $json);

        return $this->handleResponse($response);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $json
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function request(string $method, string $path, array $json): ResponseInterface
    {
        $apiEndpoint = self::API_ENDPOINT_TRACK;

        if (isset($json['endpoint'])) {
            $apiEndpoint = $json['endpoint'];
            unset($json['endpoint']);
        }

        $options = $this->getDefaultParams($apiEndpoint);
        $url = $apiEndpoint.$path;

        $options['json'] = $json;

        return $this->httpClient->request($method, $url, $options);
    }

    /**
     * Returns authentication parameters.
     * @return array
     */
    public function getAuth(): array
    {
        return [$this->siteId, $this->apiKey];
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        if (empty($this->appKey)) {
            throw new InvalidArgumentException("App API Key not set!");
        }

        return $this->appKey;
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        $stream = Utils::streamFor($response->getBody());

        return json_decode($stream->getContents(), $this->assocResponse);
    }

    /**
     * Get default Guzzle options
     * @param $endpoint
     * @return array
     */
    protected function getDefaultParams($endpoint): array
    {
        switch ($endpoint) {
            case self::API_ENDPOINT_BETA:
            case self::API_ENDPOINT:
                return [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->getToken(),
                        'Accept' => 'application/json',
                    ],
                    'connect_timeout' => 2,
                    'timeout' => 5,
                ];
            default:
                return [
                    'auth' => $this->getAuth(),
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'connect_timeout' => 2,
                    'timeout' => 5,
                ];
        }
    }
}
