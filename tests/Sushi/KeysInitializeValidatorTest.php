<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;
use Sushi\Validator\Exceptions\{
    NotInitializedKeyException,
    NotExistingKeyException as ValidatorNotExistingKeyException
};
use Sushi\Validator\{
    InitializeValidator,
    KeysValidator
};
use Sushi\ValueObject;

class KeysInitializeValidatorTest extends TestCase
{
    const VALIDATORS = [
        KeysValidator::class,
        InitializeValidator::class,
    ];

    const KEYS = [
        'foo',
        'bar',
    ];

    const EXAMPLE_DATA = [
        'foo' => 'foo data',
        'bar' => 'bar data',
    ];

    public function testInstantiate(): void
    {
        $vo = $this->getValueObject(self::EXAMPLE_DATA);

        $this->assertInstanceOf(ValueObject::class, $vo);
        $this->assertSame($vo['foo'], self::EXAMPLE_DATA['foo']);
        $this->assertSame($vo['bar'], self::EXAMPLE_DATA['bar']);
    }

    public function testInstantiateEmpty(): void
    {
        $this->expectException(NotInitializedKeyException::class);

        $this->getValueObject([]);
    }

    public function testInstantiatePartial(): void
    {
        $this->expectException(NotInitializedKeyException::class);

        $this->getValueObject([
            'foo' => 'data',
        ]);
    }

    public function testInstantiateWithNonExistingKey(): void
    {
        $this->expectException(ValidatorNotExistingKeyException::class);

        $this->getValueObject([
            'notExisting' => false,
        ]);
    }

    public function testGetNotExistingKey(): void
    {
        $vo = $this->getValueObject(self::EXAMPLE_DATA);

        $this->assertSame(null, $vo['notExisting']);
    }

    private function getValueObject(array $values)
    {
        return new class ($values) extends ValueObject {
            protected $validators = KeysInitializeValidatorTest::VALIDATORS;
            protected $keys = KeysInitializeValidatorTest::KEYS;
        };
    }
}
