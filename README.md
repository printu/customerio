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
        "printu/customerio": "~0.1.0"
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
    'site_id' => 'YOUS_SITE_ID'
]);
?>
```

### Local Testing

Run `phpunit` from the project root to start all tests.

### Examples


## License

MIT license. See the [LICENSE](LICENSE) file for more details.