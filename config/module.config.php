<?php
return array(
    'controllers' => array(
        'factories' => [
            'Firelike\ITunes\Controller\Console' => Firelike\ITunes\Controller\Factory\ConsoleControllerFactory::class
        ]
    ),
    'service_manager' => array(
        'factories' => array(
            Firelike\ITunes\Service\SearchService::class => Firelike\ITunes\Service\Factory\SearchServiceFactory::class,
            Firelike\ITunes\Validator\SearchServiceRequestValidator::class => Firelike\ITunes\Validator\Factory\SearchServiceRequestValidatorFactory::class,
            Firelike\ITunes\Validator\MediaValidator::class => Firelike\ITunes\Validator\Factory\MediaValidatorFactory::class,
            Firelike\ITunes\Validator\EntityValidator::class => Firelike\ITunes\Validator\Factory\EntityValidatorFactory::class,
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'itunes-search' => array(
                    'options' => array(
                        'route' => 'itunes search [--term=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\ITunes\Controller\Console',
                            'action' => 'search'
                        )
                    )
                ),
                'itunes-lookup' => array(
                    'options' => array(
                        'route' => 'itunes lookup [--id=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\ITunes\Controller\Console',
                            'action' => 'lookup'
                        )
                    )
                ),
            )
        )
    ),
    'itunes_service' => [
        'description' => [
            'baseUri' => 'https://itunes.apple.com',
            'apiVersion' => 'v3',
            'operations' => [
                'search_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/search',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'term' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query',
                            'description' => 'The URL-encoded text string you want to search for. For example: jack+johnson.'
                        ],
                        'country' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query',
                            'description' => 'The two-letter country code for the store you want to search. The search uses the default store front for the specified country. For example: US. The default is US.'
                        ],
                        'media' => [
                            'type' => 'string',
                            'location' => 'query',
                            'description' => 'The media type you want to search for. For example: movie. The default is all.'
                        ],
                        'entity' => [
                            'type' => 'date-time',
                            'location' => 'query',
                            'description' => 'The type of results you want returned, relative to the specified media type.For example: movieArtist for a movie media type search. '
                        ],
                        'attribute' => [
                            'type' => 'string',
                            'location' => 'query',
                            'description' => 'The attribute you want to search for in the stores, relative to the specified media type'
                        ],
                        'callback' => [
                            'type' => 'string',
                            'location' => 'query',
                            'description' => 'The name of the Javascript callback function you want to use when returning search results to your website. For example: wsSearchCB.'
                        ],
                        'limit' => [
                            'type' => 'integer',
                            'location' => 'query',
                            'description' => 'The number of search results you want the iTunes Store to return. For example: 25.The default is 50.'
                        ],
                        'lang' => [
                            'type' => 'integer',
                            'location' => 'query',
                            'description' => 'The language, English or Japanese, you want to use when returning search results. Specify the language using the five-letter codename. For example: en_us.The default is en_us (English).'
                        ],
                        'version' => [
                            'type' => 'integer',
                            'location' => 'query',
                            'description' => 'The search result key version you want to receive back from your search.The default is 2.'
                        ],
                        'explicit' => [
                            'type' => 'integer',
                            'location' => 'query',
                            'description' => 'A flag indicating whether or not you want to include explicit content in your search results.The default is Yes.'
                        ]
                    ]
                ],
                'lookup_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/lookup',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'id' => [
                            "location" => "query",
                            "description" => "iTunes ID",
                            "type" => "string"
                        ],
                        'amgArtistId' => [
                            "location" => "query",
                            "description" => "AMG artist ID",
                            "type" => "string"
                        ],
                        'upc' => [
                            "location" => "query",
                            "description" => "upc",
                            "type" => "string"
                        ],
                        'amgAlbumId' => [
                            "location" => "query",
                            "description" => "AMG Album ID",
                            "type" => "string"
                        ],
                        'amgVideoId' => [
                            "location" => "query",
                            "description" => "AMG Video ID",
                            "type" => "string"
                        ],
                        'isbn' => [
                            "location" => "query",
                            "description" => "13 digit ISBN",
                            "type" => "string"
                        ],
                        'entity' => [
                            "location" => "query",
                            "description" => "Entity",
                            "type" => "string"
                        ],
                        'limit' => [
                            "location" => "query",
                            "description" => "limit",
                            "type" => "string"
                        ],
                        'sort' => [
                            "location" => "query",
                            "description" => "sort",
                            "type" => "string"
                        ]
                    ]
                ],
                'feed_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/svc/books/v3/reviews.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'api-key' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ],
                        'author' => [
                            'type' => 'string',
                            'location' => 'query'
                        ]
                    ]
                ]
            ],
            'models' => [
                'getResponse' => [
                    'type' => 'object',
                    "properties" => [
                        "success" => [
                            "type" => "string",
                            "required" => true
                        ],
                        "errors" => [
                            "type" => "array",
                            "items" => [
                                "type" => "object",
                                "properties" => [
                                    "code" => [
                                        "type" => "string",
                                        "description" => "The error code."
                                    ],
                                    "message" => [
                                        "type" => "string",
                                        "description" => "The detailed message from the server."
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'additionalProperties' => [
                        'location' => 'json'
                    ]
                ]
            ]
        ]
    ]
);


