## iTunes API Client

[![Build Status](https://travis-ci.org/firelike/itunes-api.svg?branch=master&format=flat-square)](https://travis-ci.org/firelike/itunes-api)
[![License](https://poser.pugx.org/firelike/itunes-api/license?format=flat-square)](https://packagist.org/packages/firelike/itunes-api)


## Introduction

Zend Framework module to consume iTunes API

## Installation
Install the module using Composer into your application's vendor directory. Add the following line to your
`composer.json`.

```json
{
    "require": {
        "firelike/itunes-api": "^1.0"
    }
}
```
## Configuration

Enable the module in your `application.config.php` file.

```php
return array(
    'modules' => array(
        'Firelike\ITunes'
    )
);
```

Copy and paste the `itunes.local.php.dist` file to your `config/autoload` folder and customize it with your credentials and
other configuration settings. Make sure to remove `.dist` from your file.Your `itunes.local.php` might look something like the following:

```php
<?php
return [
    'itunes_service' => [
        'log'=>[
            'enable'=>false,
            'message_formats'=>[
                '{method} {uri} HTTP/{version} {req_body}',
                'RESPONSE: {code} - {res_body}',
            ],
            'logger'=>[
                 'stream' => 'php://output',
            ]
        ]
    ]
];
```

## Usage

Calling from your code:

```php
        use Firelike\ITunes\Request\AbstractRequest;
        use Firelike\ITunes\Request\Search as SearchRequest;
        use Firelike\ITunes\Service\ITunesService;

        
        $request = new SearchRequest();
        $request->setTerm('micheal connelly')
            ->setMedia('audiobook')
            ->setLimit(25);

        $service = new ITunesService();
        $result = $service->search($request);
        
        $numberOfRecords = $result->toArray()['resultCount'];
        var_dump($numberOfRecords);

        $records= $result->toArray()['results'];
        var_dump($records);
        
```

Using the console:

```php
php public/index.php itunes search -v
```
## Implemented Service Methods:

* **search**
* **lookup**
* **feed**
* **availableFeeds**
* **genres**


## Links

* [Zend Framework website](http://framework.zend.com)
* [iTunes Search API](https://affiliate.itunes.apple.com/resources/documentation/itunes-store-web-service-search-api/)
* [Apple RSS feeds](http://www.apple.com/rss/)
* [iTunes RSS Feed Generator](https://rss.itunes.apple.com/)
