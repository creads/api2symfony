# Api2Symfony

PHP library to automatically generate Symfony2 controllers from API specifications (RAML, Blueprint, Swagger...)

BUT... We only support the following specification formats now:

*  RAML

But we'd like to also support:

* Blueprint
* Swagger

> Feel free to submit your PRs !

## Installation

Using composer:

```sh
composer require creads/api2symfony 1.0.*@dev
```

## Use case

```php
//prepare RAML converter
$converter = new Creads\Api2Symfony\Converter\RamlConverter();

//prepare dumper
$dumper = new Creads\Api2Symfony\Dumper\SymfonyDumper();

//get controller models from specification
$controllers = $converter->convert('path/to/spec.raml');

//dump each controller into current directory
foreach($controllers as $controller) {
  $dumper->dump(controller);
}
```

## Run tests

```sh
composer install --dev
php vendor/bin/phpunit
```

## Contributors

* [Quentin Pautrat](https://github.com/qpautrat)
* [Damien Pitard](https://github.com/pitpit)

## Contributing

Feel free to contribute on github by submitting any issue or question on [tracker](https://github.com/creads/api2symfony/issues).
