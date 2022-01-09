# Value Object implementation

[![PHP Composer](https://github.com/lbacik/value-object/actions/workflows/php.yml/badge.svg)](https://github.com/lbacik/value-object/actions/workflows/php.yml)
[![codecov](https://codecov.io/gh/lbacik/value-object/branch/master/graph/badge.svg?token=B17DQFNKRM)](https://codecov.io/gh/lbacik/value-object)

## Instalation

Value Object on packagist: https://packagist.org/packages/lbacik/value-object.
To install it you can use [composer](https://getcomposer.org):

    composer require lbacik/value-object

## Usage

There are three possible ValueObject's types to use:

1. `ValueObject` - "the old one", however, it can be used now with Invariants now.
2. `ValueObjectDKeys` - "simple one" - with dynamically defined keys via the constructor's named arguments 
   and with validation based on Invariants.
3. `ValueObjectPKeys` - with predefined keys - it can be useful if you want to use built-in validators instead of Invariants. 

Examples and more detailed descriptions can be found (if not now, then soon ;))  at: https://lbacik.github.io/php-sushi 

## Example

This example uses assertion, but it is not "THE MUST" of course :)

```php
declare(strict_types=1);

use Sushi\ValueObject\Invariant;
use Sushi\ValueObjectDKeys;
use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertIsInt;
use function PHPUnit\Framework\assertIsString;

class ExampleValueObject extends ValueObjectDKeys
{
    public const NAME = 'name';
    public const AGE = 'age';
        
    #[Invariant]
    protected function validateName(): void
    {
        assertIsString($this->offsetGet(self::NAME));
    }
    
    #[Invariant]
    protected function validateAge(): void
    {
        $age = $this->offsetGet(self::AGE);

        assertIsInt($age);
        assertGreaterThanOrEqual(0, $age);    
    }
}

$valueObjectOne = new ExampleValueObject(name: "Foo", age: 30);
```

For **more information** please visit: https://lbacik.github.io/php-sushi (should be updated soon!)

