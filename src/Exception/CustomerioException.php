<?php

namespace Customerio\Exception;

use GuzzleHttp\Command\Event\CommandEvent;
use GuzzleHttp\Command\Exception\CommandException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

class CustomerioException extends CommandException
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * Simple exception factory for creating Customer.io standardised exceptions
     *
     * @param RequestInterface $request The Request
     * @param ResponseInterface $response The response
     * @param CommandEvent $event
     * @return BadResponseException
     */
    public static function factory(RequestInterface $request, ResponseInterface $response, CommandEvent $event)
    {
        $response_json = $response->json();
        $unavailable_error = null;
        $statusCode = $response->getStatusCode();

        if (!static::isValidError($response_json)) {
            if (static::isServerError($statusCode)) {
                $label = 'Server error response';
                $class = __NAMESPACE__ . '\\ServerErrorResponseException';
                $unavailable_error = 'Service Unavailable: Back-end server is at capacity';
            } else {
                $label = 'Unsuccessful response';
                $class = __CLASS__;
            }
        } elseif (static::isClientError($statusCode)) {
            $label = 'Client error response';
            $class = __NAMESPACE__ . '\\ClientErrorResponseException';
        } elseif (static::isServerError($statusCode)) {
            $label = 'Server error response';
            $class = __NAMESPACE__ . '\\ServerErrorResponseException';
        } else {
            $label = 'Unsuccessful response';
            $class = __CLASS__;
        }

        $message = $label . PHP_EOL . implode(
            PHP_EOL,
            array(
                '[status code] ' . $response->getStatusCode(),
                '[reason phrase] ' . $response->getReasonPhrase(),
                '[url] ' . $request->getUrl(),
            )
        );

        /** @var CustomerioException $e */
        $e = new $class($message, $event->getTransaction());

        // Sets the errors if the error response is the standard Customer.io error type
        if (static::isValidError($response_json)) {
            $e->setErrors([
                array(
                    'code' => $statusCode,
                    'message' => $response_json['meta']['error']
                )
            ]);
        } elseif ($unavailable_error != null) {
            $e->setErrors([
                array(
                    'code' => 'service_unavailable',
                    'message' => $unavailable_error
                )
            ]);
        }

        return $e;
    }

    /**
     * Verifies that a response body is a standard Customerio error
     * @param $response_body
     * @return bool
     */
    private static function isValidError($response_body)
    {
        if (array_key_exists('meta', $response_body) &&
            array_key_exists('error', $response_body['meta'])
        ) {
            return true;
        }

        return false;
    }

    /**
     * Gets errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * Checks if HTTP Status code is Server Error (5xx)
     *
     * @param int $statusCode
     * @return bool
     */
    public static function isServerError($statusCode)
    {
        return $statusCode >= 500 && $statusCode < 600;
    }

    /**
     * Checks if HTTP Status code is a Client Error (4xx)
     *
     * @param int $statusCode
     * @return bool
     */
    public static function isClientError($statusCode)
    {
        return $statusCode >= 400 && $statusCode < 500;
    }
}
