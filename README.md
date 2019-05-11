# Value Object implementation

[![Build Status](https://travis-ci.com/lbacik/value-object.svg?branch=master)](https://travis-ci.com/lbacik/value-object)

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

