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
        $responseJson = $response->json();
        $unavailableError = null;
        $statusCode = $response->getStatusCode();

        // Set defaults
        $label = 'Unsuccessful response';
        $class = __CLASS__;

        if (!static::isValidError($responseJson)) {
            if (static::isServerError($statusCode)) {
                $label = 'Server error response';
                $class = __NAMESPACE__ . '\\ServerErrorResponseException';
                $unavailableError = 'Service Unavailable: Back-end server is at capacity';
            }
        } elseif (static::isClientError($statusCode)) {
            $label = 'Client error response';
            $class = __NAMESPACE__ . '\\ClientErrorResponseException';
        } elseif (static::isServerError($statusCode)) {
            $label = 'Server error response';
            $class = __NAMESPACE__ . '\\ServerErrorResponseException';
        }

        $message = $label . PHP_EOL . implode(
            PHP_EOL,
            array(
                '[status code] ' . $response->getStatusCode(),
                '[reason phrase] ' . $response->getReasonPhrase(),
                '[url] ' . $request->getUrl(),
            )
        );

        /** @var CustomerioException $exception */
        $exception = new $class($message, $event->getTransaction());

        // Sets the errors if the error response is the standard Customer.io error type
        if (static::isValidError($responseJson)) {
            $exception->setErrors([
                array(
                    'code' => $statusCode,
                    'message' => $responseJson['meta']['error']
                )
            ]);
        } elseif ($unavailableError != null) {
            $exception->setErrors([
                array(
                    'code' => 'service_unavailable',
                    'message' => $unavailableError
                )
            ]);
        }

        return $exception;
    }

    /**
     * Verifies that a response body is a standard Customerio error
     * @param $responseBody
     * @return bool
     */
    private static function isValidError($responseBody)
    {
        if (array_key_exists('meta', $responseBody) &&
            array_key_exists('error', $responseBody['meta'])
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
