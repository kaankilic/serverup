# ServerUp Tool

Basic useful Server Uptime and connection checker tool.

[![Build Status](https://travis-ci.org/kaankilic/serverup.svg?branch=master)](https://travis-ci.org/kaankilic/serverup)
[![Total Downloads](https://poser.pugx.org/kaankilic/serverup/downloads)](https://packagist.org/packages/kaankilic/serverup)
[![Latest Stable Version](https://poser.pugx.org/kaankilic/serverup/v/stable)](https://packagist.org/packages/kaankilic/serverup)[![Latest Unstable Version](https://poser.pugx.org/kaankilic/serverup/v/unstable)](https://packagist.org/packages/kaankilic/serverup)
[![License](https://poser.pugx.org/kaankilic/serverup/license)](https://packagist.org/packages/kaankilic/serverup)

## Installation
You can install the package via composer:

```sh
composer require kaankilic/serverup
```
or require the tool in your **composer.json** file.
```sh
"kaankilic/serverup": "^2.0"
```
then run `composer install` command from your command line.

Once **ServerUp** is installed you need to register the service provider.Open up **config/app.php** and add the provider key of tool.
```php
'providers' => array(
	...
    Kaankilic\ServerUp\Providers\ServerUpServiceProvider::class,
)
```
After that, you need to register the facade in the aliases key of your config/app.php file.
```php
'aliases' => array(
	... aliases
	'ServerUp'=> Kaankilic\ServerUp\Facades\ServerUp::class,
)
```

Finally, from the command line again, publish the default configuration file:

```php
php artisan vendor:publish --provider="Kaankilic\ServerUp\Providers/ServerUpServiceProvider"
```

## Usage
You need to set Hostname and Port values for the ping values.
```php
	ServerUp::setHostname("http://facebook.com");
	ServerUp::setPort(80);
	dd(ServerUp::ping());
```
You can get availibility of ip or domain with ping() facades. Example code is on the below:
```php
	ServerUp::setHostname("http://facebook.com");
	ServerUp::setPort(80);
	dd(ServerUp::ping());
```
