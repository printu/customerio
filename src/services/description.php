<?php return [
    'apiVersion' => 1,
    'name' => 'Customer.io API',
    'description' => 'The Customer.io API',
    'baseUrl' => 'https://track.customer.io/',
    'operations' => [
        'addCustomer' => [
            'httpMethod' => 'PUT',
            'uri' => '/api/v{ApiVersion}/customers/{id}',
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
            'summary' => 'Deletes a contact given id',
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
