# Value Object implementation

[![PHP Composer](https://github.com/lbacik/value-object/actions/workflows/php.yml/badge.svg)](https://github.com/lbacik/value-object/actions/workflows/php.yml)
[![codecov](https://codecov.io/gh/lbacik/value-object/branch/master/graph/badge.svg?token=B17DQFNKRM)](https://codecov.io/gh/lbacik/value-object)

## Instalation

Value Object on packagist: https://packagist.org/packages/lbacik/value-object.
To install it you can use [composer](https://getcomposer.org):

    composer require lbacik/value-object


## Example

```php
use Sushi\ValueObject;

class ExampleValueObject extends ValueObject
{
    protected $validators = [
        KeysValidator::class,
        InitializeValidator::class,
    ];

    protected $keys = [
        'firstname',
        'lastname',
        'city',
        'occupation',
    ]
}
```

For **more information** please visit: https://lbacik.github.io/php-sushi/docs/ValueObject.html

