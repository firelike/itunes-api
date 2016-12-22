<?php
return array(
    'controllers' => array(
        'factories' => [
            'Firelike\ITunes\Controller\Console' => Firelike\ITunes\Controller\Factory\ConsoleControllerFactory::class
        ]
    ),
    'service_manager' => array(
        'factories' => array(
            Firelike\ITunes\Service\ITunesService::class => Firelike\ITunes\Service\Factory\ITunesServiceFactory::class,
            Firelike\ITunes\Validator\ITunesServiceRequestValidator::class => Firelike\ITunes\Validator\Factory\ITunesServiceRequestValidatorFactory::class,
            Firelike\ITunes\Validator\EntityValidator::class => Firelike\ITunes\Validator\Factory\EntityValidatorFactory::class,
            Firelike\ITunes\Validator\FeedTypeValidator::class => Firelike\ITunes\Validator\Factory\FeedTypeValidatorFactory::class,
            Firelike\ITunes\Validator\MediaValidator::class => Firelike\ITunes\Validator\Factory\MediaValidatorFactory::class,
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
                'itunes-feed' => array(
                    'options' => array(
                        'route' => 'itunes feed [--genre=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\ITunes\Controller\Console',
                            'action' => 'feed'
                        )
                    )
                ),
                'itunes-available-feeds' => array(
                    'options' => array(
                        'route' => 'itunes available-feeds [--country=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\ITunes\Controller\Console',
                            'action' => 'available-feeds'
                        )
                    )
                ),
                'itunes-genres' => array(
                    'options' => array(
                        'route' => 'itunes genres [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\ITunes\Controller\Console',
                            'action' => 'genres'
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
                            'type' => 'string',
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
                    'uri' => '/rss/{type}/limit={size}{+genre}/{format}',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'type' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'uri'
                        ],
                        'size' => [
                            'type' => 'integer',
                            'required' => true,
                            'default' => 100,
                            'location' => 'uri'
                        ],
                        'genre' => [
                            'type' => 'integer',
                            'required' => false,
                            'location' => 'uri',
                            'filters' => array(
                                function ($data) {
                                    return '/genre=' . $data;
                                }
                            ),
                        ],
                        'format' => [
                            'type' => 'string',
                            'required' => true,
                            'default' => 'json',
                            'location' => 'uri',
                            'pattern' => '/^json|xml$/'
                        ]
                    ]
                ],
                'available_feeds_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/WebObjects/MZStoreServices.woa/wa/RSS/wsAvailableFeeds',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'cc' => [
                            'type' => 'string',
                            'required' => true,
                            'default' => 'us',
                            'location' => 'query',
                            'description' => 'fetch available feeds by country code'
                        ]
                    ]
                ],
                'genres' => [
                    'httpMethod' => 'GET',
                    'uri' => '/WebObjects/MZStoreServices.woa/ws/genres',
                    'responseModel' => 'getResponse',
                    'parameters' => [],
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


