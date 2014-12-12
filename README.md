# Api 2 Symfony

Provide a way to convert a given specification into Symfony controller instances.

## Installation

#### Via composer

`composer require creads/api2symfony 1.1.0`

## Specifications supported:

* RAML


## Use case

    $converter = new Creads\Api2Symfony\RamlConverter(new Raml\Parser);
    $controllers = $converter->convert('path/to/raml')

## Tests

`php vendor/bin/phpunit`

## Contributors

* [Quentin Pautrat](https://github.com/qpautrat)

## Contributing

Feel free to contribute on github by submitting any issue or question

## License

Distributed under MIT license
