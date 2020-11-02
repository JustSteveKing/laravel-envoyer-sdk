# Laravel Envoyer SDK

<!-- BADGES_START -->
[![Latest Version][badge-release]][packagist]
[![PHP Version][badge-php]][php]
![tests](https://github.com/JustSteveKing/laravel-envoyer-sdk/workflows/tests/badge.svg)
![Check & fix styling](https://github.com/JustSteveKing/laravel-envoyer-sdk/workflows/Code%20style/badge.svg)
[![Total Downloads][badge-downloads]][downloads]

[badge-release]: https://img.shields.io/packagist/v/juststeveking/laravel-envoyer-sdk.svg?style=flat-square&label=release
[badge-php]: https://img.shields.io/packagist/php-v/juststeveking/laravel-envoyer-sdk.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/juststeveking/laravel-envoyer-sdk.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/juststeveking/laravel-envoyer-sdk
[php]: https://php.net
[downloads]: https://packagist.org/packages/juststeveking/laravel-envoyer-sdk
<!-- BADGES_END -->

A simple to use PHP class to work with the Laravel Envoyer API

## Requirements

- PHP ^7.4
- PHP ext-json


## Installation

The preferred method of installation is to use composer:

```bash
$ composer require juststeveking/laravel-envoyer-sdk
```

To work with this package, firstly you **must** have a [Laravel Envoyer](https://envoyer.io/) account, and secondly you must create an API token through [Laravel Envoyer](https://envoyer.io/) itself.


## Usage

You create a simple SDK like so:

```php
use JustSteveKing\Laravel\Envoyer\SDK\Envoyer;

$envoyer = Envoyer::illuminate(
    API_TOKEN_HERE,
    'https://envoyer.io/' // this is optional as is the default
);
```

Once you have `$envoyer` set up, you can now start to work with the resources through the API:

