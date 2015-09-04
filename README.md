Rancher PHP
===========

RancherPHP is a PHP client for interacting with the [Rancher](http://rancher.com/rancher/) API. Rancher's API provides a traversable tree
or resources and RancherPHP exposes these in a simple interface.

```php
$client = new Rancher\Client('http://localhost:9000/v1', 'key', 'secret');
$projects = $client->getProjects();

$services = $projects->first()->getServices();
```

## Installing RancherPHP
The recommended way to install RancherPHP is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of RancherPHP:

```bash
composer.phar require haswalt/rancher-php
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update RancherPHP using composer:

```bash
composer.phar update
```

## TODO

- Implement more resource types
- Add tests
- Implement complex actions
