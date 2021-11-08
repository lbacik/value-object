<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;
use Sushi\Validator\Exceptions\NotInitializedKeyException;
use Sushi\Validator\InitializeValidator;
use Sushi\ValueObject;

class InitializeValidatorTest extends TestCase
{
    const VALIDATORS = [
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

    public function testInstantiateWithNonExistingKey(): void
    {
        $this->expectException(NotInitializedKeyException::class);

        $this->getValueObject([
            'notExisting' => false,
        ]);
    }

    public function testGetNotExistingKey(): void
    {
        $vo = $this->getValueObject(self::EXAMPLE_DATA);

        $this->assertSame(null, $vo['notExisting']);
    }

    public function testSet(): void
    {
        $vo1 = $this->getValueObject(self::EXAMPLE_DATA);

        $vo2 = $vo1->set([
            'foo' => 1,
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo2);
        $this->assertSame($vo2['foo'], 1);
    }

    public function testSetNotExistingKey(): void
    {
        $vo1 = $this->getValueObject(self::EXAMPLE_DATA);

        $vo2 = $vo1->set([
            'notExisting' => false,
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo2);
        $this->assertSame($vo2['notExisting'], false);
    }

    private function getValueObject(array $values)
    {
        return new class ($values) extends ValueObject {
            protected $validators = InitializeValidatorTest::VALIDATORS;
            protected $keys = InitializeValidatorTest::KEYS;
        };
    }
}
