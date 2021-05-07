<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Campaigns extends Base
{
    /**
     * List campaigns
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_list
     * @param array $options
     * @return mixed
     * @throws GuzzleException
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
     * @throws GuzzleException
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
     * @throws GuzzleException
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
     * @throws GuzzleException
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
     * @throws GuzzleException
     */
    public function trigger(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->campaignPath($options['id'], ['triggers']);
        unset($options['id']);

        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->post($path, $options);
    }

    /**
     * Get triggered campaigns
     * @see https://learn.customer.io/api/#apibeta-apicampaignscampaigns_messages
     * @param array $options
     * @return mixed
     * @throws GuzzleException
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

    /**
     * List campaign actions
     * @see https://customer.io/docs/api/#apibeta-apicampaignscampaigns_index_actions
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function actions(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->campaignPath($options['id'], ['actions']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get action of a campaign by id.
     * @see https://customer.io/docs/api/#apibeta-apicampaignscampaigns_get_action
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function getAction(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'GET');
        } // @codeCoverageIgn

        if (!isset($options['action_id'])) {
            $this->mockException('Action id is required!', 'GET');
        } // @codeCoverageIgn

        $path = $this->campaignPath($options['id'], ['actions', $options['action_id']]);
        unset($options['id']);
        unset($options['action_id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get action metrics of a campaign
     * @see https://customer.io/docs/api/#apibeta-apicampaignscampaign_action_metrics
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function getActionMetrics(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Campaign id is required!', 'GET');
        } // @codeCoverageIgn

        if (!isset($options['action_id'])) {
            $this->mockException('Action id is required!', 'GET');
        } // @codeCoverageIgn

        $path = $this->campaignPath($options['id'], ['actions', $options['action_id'], 'metrics']);
        unset($options['id']);
        unset($options['action_id']);

        return $this->client->get($path, $options);
    }
}
