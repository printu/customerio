# Customer.io API Client

PHP bindings for the Customer.io API.

[API Documentation](https://www.customer.io/docs/api/)

[![Actions Status](https://github.com/printu/customerio/workflows/PHP%20Composer/badge.svg?branch=master)](https://github.com/printu/customerio/actions)
[![Code Climate](https://codeclimate.com/github/printu/customerio/badges/gpa.svg)](https://codeclimate.com/github/printu/customerio)
[![Test Coverage](https://codeclimate.com/github/printu/customerio/badges/coverage.svg)](https://codeclimate.com/github/printu/customerio/coverage)

There are two primary API hosts available for to integrate with:

**Behavioral Tracking**

https://track.customer.io/api/v1/ \
Behavioral Tracking API is used to identify and track customer data with Customer.io.

**API**

https://api.customer.io/v1/api/ \
API allows you to read data from your Customer.io account for use in custom workflows in your backend system or for reporting purposes.

## Installation

The API client can be installed via [Composer](https://github.com/composer/composer).

In your composer.json file:

```json
{
    "require": {
        "printu/customerio": "~3.0"
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

/*
 * To authenticate, provide your key as a Bearer token in a HTTP Authorization header.
 * You can create and manage your API keys by visiting your App API Keys page directly or by clicking the Integrations
 *  link in the left-hand menu of your Customer.io account and choosing Customer.io API > Manage API Credentials > App API Keys.
 */
$client->setAppAPIKey('APP_KEY');

?>
```

Change region to EU

```php
<?php
use Customerio\Client;

$client = new Client('YOUR_API_KEY', 'YOUR_SITE_ID', ['region' => 'eu']);

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
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}

// Get customer
try {
    $client->customers->get(
        [
            'email' => 'user@example.com',        
        ]
    );
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
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
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error   
}

// Delete customer
try {
    $client->customers->delete(
        [
            'id' => 1,
        ]
    );
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
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
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}

// Add anonymous event
try {
    $client->events->anonymous(
        [
            'name' => 'invite-friend',
            'data' => [
                'recipient' => 'invitee@example.com'
            ]
        ]
    );
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

Anonymous event [example](http://customer.io/docs/invitation-emails.html) usage.

#### Segments
```php
<?php
// Get segment data
try {
    $client->segments->get(
        [
            'id' => 1
        ]
    );
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

Check for other available methods [here](https://customer.io/docs/api/#apibeta-apisegmentssegments_list)

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
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

#### Campaigns

```php
<?php
// Get campaigns data
try {
    $client->campaigns->get(
        [
            'id' => 1
        ]
    );
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

Check for other available methods [here](https://customer.io/docs/api/#apibeta-apicampaignscampaigns_get)

```php
<?php
// Trigger broadcast campaign
try {
    $result = $client->campaigns->trigger(
        [
            'id' => 1,
            'data' => [
                'headline' => 'Roadrunner spotted in Albuquerque!',
                'date' => 'January 24, 2018', 
                'text' => 'We\'ve received reports of a roadrunner in your immediate area! Head to your dashboard to view more information!' 
            ],
            'recipients' => [
                'segments' => [
                    'id' => 1
                ]
            ]
        ]
    );
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

See [here](https://learn.customer.io/documentation/api-triggered-data-format.html) for more examples of API Triggered Broadcasts

## V2 Track API

The Track API allows you to send entity-based operations to Customer.io. You can use it for both single operations and batch operations.

> Note: The `identify` action is used to create or update an entity.

### Single Entity Operation

#### Create or update a person entity.

```php
<?php
// Single entity operation
try {
    $client->track->entity([
        'type' => 'person',
        'action' => 'identify',
        'identifiers' => [
            'id' => '123' // or 'email' => 'test@example.com' or 'cio_id' => 'cio_123'
        ],
        'attributes' => [
            'name' => 'John Doe',
            'plan' => 'premium',
            'test_attribute' => null, // pass null to remove the attribute from the entity
            'last_activity_at' => time()
        ]
    ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

#### Create or update an object entity.

```php
<?php
// Create or update an object
try {
    $client->track->entity([
        'type' => 'object',
        'action' => 'identify',
        'identifiers' => [
            'object_type_id' => 'product',
            'object_id' => 'SKU-123'
        ],
        'attributes' => [
            'name' => 'Awesome Product',
            'price' => 99.99,
            'category' => 'Electronics'
        ]
    ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

#### Delete an entity

```php
<?php
// Delete an entity
try {
    $client->track->entity([
        'type' => 'person',
        'action' => 'delete',
        'identifiers' => [
            'id' => '123'
        ]
    ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

#### Add relationships to a person

```php
<?php
// Add relationships to a person entity
try {
    $client->track->entity([
        'type' => 'person',
        'action' => 'add_relationships',
        'identifiers' => [
            'id' => '123'
        ],
        'cio_relationships' => [
            'identifiers' => [
                'object_type_id' => 'product',
                'object_id' => 'SKU-123'
            ],
            'relationship_attributes' => [
                'role' => 'client',
                'created_at' => '2024-01-01T10:12:00Z'
            ]
        ]
    ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

### Batch Operations

```php
<?php
// Batch multiple operations
try {
    $client->track->batch([
        'batch' => [
            [
                'type' => 'person',
                'action' => 'identify',
                'identifiers' => ['id' => '123'],
                'attributes' => ['name' => 'John Doe']
            ],
            [
                'type' => 'person',
                'action' => 'event',
                'identifiers' => ['id' => '123'],
                'name' => 'purchased',
                'timestamp' => time(),
                'attributes' => ['product_id' => 'SKU-123']
            ],
            [
                'type' => 'object',
                'action' => 'identify',
                'identifiers' => [
                    'object_type_id' => 'product',
                    'object_id' => 'SKU-123'
                ],
                'attributes' => ['in_stock' => true]
            ]
        ]
    ]);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // Handle the error
}
```

### Main differences with V1

The Track V2 API introduces an entity-centric approach, contrasting with V1's action-based model. The key difference lies in the request structure:

- V1 API: Actions come first (identify, track event) through the endpoint followed by the target entity you provide.
- V2 API: The target entity type comes first (person, object) followed by the action to perform.

This new approach provides a more intuitive way to interact with your data by focusing first on what entity you're working with before specifying what you want to do with it. It also allows the API to have only two endpoint for all operations.

In theory, all v1 operations can be done with v2 but the v2 API does not support all v1 operations yet.

For more details, see the [Track V2 API documentation](https://docs.customer.io/api/track/#tag/track_v2).
```

## License

MIT license. See the [LICENSE](LICENSE) file for more details.