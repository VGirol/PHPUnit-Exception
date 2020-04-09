# PHPUnit-Exception

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Infection MSI][ico-mutation]][link-mutation]
[![Total Downloads][ico-downloads]][link-downloads]

## Technologies

- PHP 7.2
- PHPUnit 8

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require-dev": {
        "VGirol/PHPUnit-Exception": "dev-master"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplified by using the following command:

``` bash
$ composer require vgirol/phpunit-exception
```

## Usage

``` php
use PHPUnit\Framework\TestCase as BaseTestCase;
use VGirol\PhpunitException\SetExceptionsTrait;

class TestCase extends BaseTestCase
{
    use SetExceptionsTrait;

    public function test()
    {
        $className = \Exception::class;
        $message = 'Error';
        $code = 666;

        $this->setFailure($className, $message, $code);

        throw new \Exception($message, $code);
    }
}
```

## Documentation

The API documentation is available in XHTML format at the url [http://PHPUnit-Exception.girol.fr/docs/index.xhtml](http://PHPUnit-Exception.girol.fr/docs/index.xhtml).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email [vincent@girol.fr](mailto:vincent@girol.fr) instead of using the issue tracker.

## Credits

- [Girol Vincent][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/VGirol/PHPUnit-Exception.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/VGirol/PHPUnit-Exception/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/VGirol/PHPUnit-Exception.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/VGirol/PHPUnit-Exception.svg?style=flat-square
[ico-mutation]: https://img.shields.io/endpoint?style=flat-square&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FVGirol%2FPHPUnit-Exception%2Fmaster
[ico-downloads]: https://img.shields.io/packagist/dt/VGirol/PHPUnit-Exception.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/VGirol/PHPUnit-Exception
[link-travis]: https://travis-ci.org/VGirol/PHPUnit-Exception
[link-scrutinizer]: https://scrutinizer-ci.com/g/VGirol/PHPUnit-Exception/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/VGirol/PHPUnit-Exception
[link-downloads]: https://packagist.org/packages/VGirol/PHPUnit-Exception
[link-author]: https://github.com/VGirol
[link-mutation]: https://dashboard.stryker-mutator.io/reports/github.com/VGirol/PHPUnit-Exception/master
[link-contributors]: ../../contributors
