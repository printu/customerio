# Customer.io API Client

PHP bindings for the Customer.io API (https://track.customer.io/).

[API Documentation](http://customer.io/docs/api/rest.html)

[![Latest Stable Version](https://poser.pugx.org/printu/customerio/v/stable)](https://packagist.org/packages/printu/customerio)
[![Build Status](https://travis-ci.org/printu/customerio.svg?branch=master)](https://travis-ci.org/printu/customerio)
[![Code Climate](https://codeclimate.com/github/printu/customerio/badges/gpa.svg)](https://codeclimate.com/github/printu/customerio)
[![Test Coverage](https://codeclimate.com/github/printu/customerio/badges/coverage.svg)](https://codeclimate.com/github/printu/customerio/coverage)

## Installation

The API client can be installed via [Composer](https://github.com/composer/composer).

In your composer.json file:

```js
{
    "require": {
        "printu/customerio": "~1.0"
    }
}
```

Once the composer.json file is created you can run `composer install` for the initial package install and `composer update` to update to the latest version of the API client.

The client uses [Guzzle](http://docs.guzzlephp.org/en/5.3/clients.html).

## Basic Usage

Remember to include the Composer autoloader in your application:

```php
<?php
require_once 'vendor/autoload.php';

// Application code...
?>
```

Configure your access credentials when creating a client:

```php
<?php
use Customerio\Client;

$client = new Client([
    'api_key' => 'YOUR_API_KEY',
    'site_id' => 'YOUR_SITE_ID'
]);
?>
```

### Local Testing

Run `phpunit` from the project root to start all tests.

### Examples

#### Customers

```php
<?php
// Create customer
try {
    $client->addCustomer(
        [
            'id' => 1,
            'email' => 'user@example.com',
            'data' => [
                'plan' => 'free',
                'created_at' => time()
            ]
        ]
    );
} catch (CustomerioException $e) {
    // Handle the error appropriately. Simple example is below
    $request = $e->getRequest();
    $url = $request->getUrl();
    $body = $request->getBody();
    error_log("[API SERVER ERROR] Status Code: {$url} | Body: {$body}");

    $response = $e->getResponse();
    $code = $response->getStatusCode();
    $body = $response->getBody();
    error_log("[API SERVER ERROR] Status Code: {$code} | Body: {$body}");
}

// Update customer
try {
    $client->updateCustomer(
        [
            'id' => 1,
            'email' => 'user@example.com',
            'data' => [
                'plan' => 'premium'
            ]
        ]
    );
} catch (CustomerioException $e) {
    // Handle the error   
}

// Delete customer
try {
    $client->deleteCustomer(
        [
            'id' => 1,
        ]
    );
} catch (CustomerioException $e) {
    // Handle the error   
}
```

#### Events

```php
<?php
// Add customer event
try {
    $client->addEvent(
        [
            'id' => 1,
            'name' => 'test-event',
            'data' => [
                'event-metadata-1' => 'test',
                'event-metadata-2' => 'test-2'
            ]
        ]
    );
} catch (CustomerioException $e) {
    // Handle the error
}

// Add anonymous event
try {
    $client->anonymousEvent(
        [
            'name' => 'invite-friend',
            'data' => [
                'recipient' => 'invitee@example.com'
            ]
        ]
    );
} catch (CustomerioException $e) {
    // Handle the error
}
```

Anonymous event [example](http://customer.io/docs/invitation-emails.html) usage.

#### PageView

```php
<?php
// Add page view
try {
    $result = $client->pageView(
        [
            'id' => 1,
            'url' => 'http://example.com/login',
            'data' => [
                'referrer' => 'http://example.com'
            ]
        ]
    );
} catch (CustomerioException $e) {
    // Handle the error
}
```

## License

MIT license. See the [LICENSE](LICENSE) file for more details.