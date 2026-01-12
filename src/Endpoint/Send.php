<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Send extends Base
{
    /**
     * Send a transactional email
     * @see https://customer.io/docs/api/#operation/sendEmail
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function email(array $options)
    {
        if (!isset($options['transactional_message_id'])) {
            if (!isset($options['body'])) {
                $this->mockException('Email body is required if transactional_message_id is missing!', 'POST');
            } // @codeCoverageIgnore

            if (!isset($options['subject'])) {
                $this->mockException('Email subject is required if transactional_message_id is missing!', 'POST');
            } // @codeCoverageIgnore

            if (!isset($options['from'])) {
                $this->mockException('Email from is required if transactional_message_id is missing!', 'POST');
            } // @codeCoverageIgnore
        }

        if (!isset($options['identifiers'])) {
            $this->mockException('Email identifiers is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['to'])) {
            $this->mockException('Email to is required!', 'POST');
        } // @codeCoverageIgnore

        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->post('send/email', $options);
    }

    /**
     * Send a transactional SMS
     * @see https://docs.customer.io/integrations/api/app/#operation/sendSMS
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function sms(array $options)
    {
        if (!isset($options['transactional_message_id'])) {
            $this->mockException('SMS transactional_message_id is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['identifiers'])) {
            $this->mockException('SMS identifiers is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['to'])) {
            $this->mockException('SMS to is required!', 'POST');
        } // @codeCoverageIgnore

        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->post('send/sms', $options);
    }
}
