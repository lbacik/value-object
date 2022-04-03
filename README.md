# Value Object implementation

[![PHP Composer](https://github.com/lbacik/value-object/actions/workflows/php.yml/badge.svg)](https://github.com/lbacik/value-object/actions/workflows/php.yml)
[![codecov](https://codecov.io/gh/lbacik/value-object/branch/master/graph/badge.svg?token=B17DQFNKRM)](https://codecov.io/gh/lbacik/value-object)

## Instalation

Value Object on packagist: https://packagist.org/packages/lbacik/value-object.
To install it you can use [composer](https://getcomposer.org):

    composer require lbacik/value-object

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
    public function __construct(
        public readonly string $name,
        public readonly int $age
    ) {
        parent::__construct();
    }
        
    #[Invariant]
    protected function validateName(): void
    {
        assertIsString($this->name);
    }
    
    #[Invariant]
    protected function validateAge(): void
    {
        assertIsInt($this->age);
        assertGreaterThanOrEqual(0, $this->age);    
    }
}

$valueObjectOne = new ExampleValueObject(name: "Foo", age: 30);
```

For **more information** please visit: https://lbacik.github.io/php-sushi (should be updated soon!)

