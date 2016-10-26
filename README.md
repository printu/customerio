# Customer.io API Client

PHP bindings for the Customer.io API (https://track.customer.io/).

[API Documentation](http://customer.io/docs/api/rest.html)

[![Build Status](https://travis-ci.org/printu/customerio.svg?branch=master)](https://travis-ci.org/printu/customerio)
[![Code Climate](https://codeclimate.com/github/printu/customerio/badges/gpa.svg)](https://codeclimate.com/github/printu/customerio)
[![Test Coverage](https://codeclimate.com/github/printu/customerio/badges/coverage.svg)](https://codeclimate.com/github/printu/customerio/coverage)

## Installation

The API client can be installed via [Composer](https://github.com/composer/composer).

In your composer.json file:

```js
{
    "require": {
        "printu/customerio": "~2.0"
    }
}
```

Once the composer.json file is created you can run `composer install` for the initial package install and `composer update` to update to the latest version of the API client.

The client uses [Guzzle](http://docs.guzzlephp.org/en/stable/).

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

$client = new Client('YOUR_API_KEY', 'YOUR_SITE_ID');
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
    $client->customers->add(
        [
            'id' => 1,
            'email' => 'user@example.com',
            'plan' => 'free',
            'created_at' => time()
        ]
    );
} catch (GuzzleException $e) {
    // Handle the error
}

// Update customer
try {
    $client->customers->update(
        [
            'id' => 1,
            'email' => 'user@example.com',
            'plan' => 'premium'
        ]
    );
} catch (GuzzleException $e) {
    // Handle the error   
}

// Delete customer
try {
    $client->customer->delete(
        [
            'id' => 1,
        ]
    );
} catch (GuzzleException $e) {
    // Handle the error   
}
```

#### Events

```php
<?php
// Add customer event
try {
    $client->customers->event(
        [
            'id' => 1,
            'name' => 'test-event',
            'data' => [
                'event-metadata-1' => 'test',
                'event-metadata-2' => 'test-2'
            ]
        ]
    );
} catch (GuzzleException $e) {
    // Handle the error
}

// Add anonymous event
try {
    $client->event->add(
        [
            'name' => 'invite-friend',
            'data' => [
                'recipient' => 'invitee@example.com'
            ]
        ]
    );
} catch (GuzzleException $e) {
    // Handle the error
}
```

Anonymous event [example](http://customer.io/docs/invitation-emails.html) usage.

#### PageView

```php
<?php
// Add page view
try {
    $result = $client->page->view(
        [
            'id' => 1,
            'url' => 'http://example.com/login',
            'data' => [
                'referrer' => 'http://example.com'
            ]
        ]
    );
} catch (GuzzleException $e) {
    // Handle the error
}
```

## License

MIT license. See the [LICENSE](LICENSE) file for more details.