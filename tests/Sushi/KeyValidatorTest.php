<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;
use Sushi\Validator\Exceptions\NotExistingKeyException as ValidatorNotExistingKeyException;
use Sushi\Validator\KeysValidator;
use Sushi\ValueObject;

class KeyValidatorTest extends TestCase
{
    const VALIDATORS = [
        KeysValidator::class,
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
        $vo = $this->getValueObject([]);

        $this->assertInstanceOf(ValueObject::class, $vo);
        $this->assertSame($vo['foo'], null);
        $this->assertSame($vo['bar'], null);
    }

    public function testInstantiateWithNotExistingKey(): void
    {
        $this->expectException(ValidatorNotExistingKeyException::class);

        $this->getValueObject([
            'notExisting' => 'foo',
        ]);
    }

    public function testGetNotExistingKey(): void
    {
        $vo = $this->getValueObject(self::EXAMPLE_DATA);

        $this->assertSame(null, $vo['notExisting']);
    }

    public function testSet(): void
    {
        $vo1 = new ValueObject(self::EXAMPLE_DATA);

        $vo2 = $vo1->set([
            'foo' => 1,
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo2);
        $this->assertSame($vo2['foo'], 1);
    }

    public function testSetMulti(): void
    {
        $vo1 = new ValueObject(self::EXAMPLE_DATA);

        $vo2 = $vo1->set([
            'foo' => 1,
            'bar' => 2,
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo2);
        $this->assertSame($vo2['foo'], 1);
        $this->assertSame($vo2['bar'], 2);
    }

    public function testSetNotExistingKey(): void
    {
        $this->expectException(ValidatorNotExistingKeyException::class);

        $vo1 = $this->getValueObject([]);
        $vo1->set([
            'notExisting' => 'foo',
        ]);
    }

    public function testSetMultiWithNotExistingKey(): void
    {
        $this->expectException(ValidatorNotExistingKeyException::class);

        $vo1 = $this->getValueObject([]);
        $vo1->set([
            'foo' => 'foo data',
            'notExisting' => 'foo',
        ]);
    }

    private function getValueObject(array $values)
    {
        return new class ($values) extends ValueObject {
            protected $validators = KeyValidatorTest::VALIDATORS;
            protected $keys = KeyValidatorTest::KEYS;
        };
    }
}
