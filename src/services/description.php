<?php return [
    'apiVersion' => 1,
    'name' => 'Customer.io API',
    'description' => 'The Customer.io API',
    'baseUrl' => 'https://track.customer.io/',
    'operations' => [
        'addCustomer' => [
            'httpMethod' => 'PUT',
            'uri' => '/api/v{ApiVersion}/customers/{id}',
            'summary' => 'Create a contact given id.',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri'
                ],
                'email' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json'
                ]
            ],
            'additionalParameters' => [
                'location' => 'json'
            ]
        ],
        'updateCustomer' => [
            'httpMethod' => 'PUT',
            'uri' => '/api/v{ApiVersion}/customers/{id}',
            'summary' => 'Identifies and updates user attributes.',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri'
                ],
                'email' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json'
                ]
            ]
        ],
        'deleteCustomer' => [
            'httpMethod' => 'DELETE',
            'uri' => '/api/v{ApiVersion}/customers/{id}',
            'summary' => 'Deletes a user from Customer.io.',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri'
                ]
            ]
        ],
        'addEvent' => [
            'httpMethod' => 'POST',
            'uri' => '/api/v{ApiVersion}/customers/{id}/events',
            'summary' => 'Records events',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri'
                ],
                'name' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'data' => [
                    'required' => false,
                    'type' => 'object',
                    'location' => 'json'
                ]
            ]
        ],
        'anonymousEvent' => [
            'httpMethod' => 'POST',
            'uri' => '/api/v{ApiVersion}/events',
            'summary' => 'Records anonymous events',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'name' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json'
                ],
                'data' => [
                    'required' => false,
                    'type' => 'object',
                    'location' => 'json'
                ]
            ]
        ]
    ],
    'models' => [
        'Result' => [
            'type' => 'object',
            'properties' => [
                'statusCode' => ['location' => 'statusCode']
            ],
            'additionalProperties' => [
                'location' => 'json'
            ]
        ]
    ]
];
