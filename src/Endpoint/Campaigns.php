<?php

namespace Customerio\Endpoint;

use Customerio\Client;

class Campaigns extends Base
{
    /**
     * List campaigns
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_list
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->campaignPath();
        return $this->client->get($path, $options);
    }

    /**
     * List campaigns
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_get
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->campaignPath($options['id']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get campaign metrics
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_get_metrics
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_get_triggers_metrics
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function metrics(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'GET');
        } // @codeCoverageIgnore

        $extra = [];
        if (isset($options['trigger_id'])) {
            $extra[] = 'triggers';
            $extra[] = $options['trigger_id'];
            unset($options['trigger_id']);
        }
        $extra[] = 'metrics';
        $path = $this->campaignPath($options['id'], $extra);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get triggered campaigns
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_get_triggers
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function triggers(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->campaignPath($options['id'], ['triggers']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Trigger Campaign Broadcast
     * @see https://learn.customer.io/api/#apicorecampaignscampaigns_trigger
     * @see https://learn.customer.io/documentation/api-triggered-data-format.html
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function trigger(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->campaignPath($options['id'], ['triggers']);
        unset($options['id']);

        $options['endpoint'] = Client::API_ENDPOINT;

        return $this->client->post($path, $options);
    }

    /**
     * Get triggered campaigns
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_messages
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function messages(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->campaignPath($options['id'], ['messages']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }
}
