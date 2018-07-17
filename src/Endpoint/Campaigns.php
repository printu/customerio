<?php

namespace Customerio\Endpoint;

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
        return $this->client->get('campaigns', $options);
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
        }

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
        }

        $path = $this->campaignPath($options['id']);

        if (isset($options['trigger_id'])) {
            $path .= '/triggers/'.$options['trigger_id'];
            unset($options['trigger_id']);
        }

        unset($options['id']);

        return $this->client->get($path.'/metrics', $options);
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
        }

        $path = $this->campaignPath($options['id']);
        unset($options['id']);

        return $this->client->get($path.'/triggers', $options);
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
        }

        $path = $this->campaignPath($options['id']);
        unset($options['id']);

        return $this->client->post($path."/triggers", $options);
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
        }

        $path = $this->campaignPath($options['id']);
        unset($options['id']);

        return $this->client->get($path.'/messages', $options);
    }
}
