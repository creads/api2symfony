# Api 2 Symfony

PHP library to automatically generate Symfony2 controllers from RAML specs.

We only support the following specification formats now:

*  RAML

But we'd like to also support:

* Blueprint
* Swagger

> Fell free to submit your PRs !

## Installation

Using composer:

`composer require creads/api2symfony 1.1.0`

## Use case

```
use Creads\Api2Symfony\RamlConverter;
use Raml\Parser;

$converter = new RamlConverter(new Parser());
$controllers = $converter->convert('path/to/spec.raml');
```

## Tests

`php vendor/bin/phpunit`

## Contributors

* [Quentin Pautrat](https://github.com/qpautrat)

## Contributing

Feel free to contribute on github by submitting any issue or question on [tracker](https://github.com/creads/api2symfony/issues).

## License

Released under MIT license.

Please reade the LICENSE file.



