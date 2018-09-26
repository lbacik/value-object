<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;
use Sushi\ValueObject;
use Sushi\ValueObject\Exceptions\ActionForbiddenException;

class ValueObjectTest extends TestCase
{
    const VALIDATORS = [];

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
        $vo = $this->getValueObject([
            'foo' => 'foo data',
            'bar' => 'bar data',
        ]);

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
        $vo = new ValueObject([
            'notExisting' => 1,
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo);
        $this->assertSame($vo['notExisting'], 1);
    }

    public function testGetNotExistingKey(): void
    {
        $vo = new ValueObject([]);

        $this->assertSame(null, $vo['notExisting']);
    }

    public function testSet(): void
    {
        $vo1 = $this->getValueObject([]);

        $vo2 = $vo1->set([
            'foo' => 'foo data',
            'notExisting' => 'foo',
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo2);
        $this->assertSame($vo2['foo'], 'foo data');
        $this->assertSame($vo2['bar'], null);
        $this->assertSame($vo2['notExisting'], 'foo');
    }

    public function testDirectSet()
    {
        $this->expectException(ActionForbiddenException::class);

        $vo = $this->getValueObject([
            'foo' => 'bar',
        ]);

        $vo['foo'] = 'foo';
    }

    public function testDirectUnSet()
    {
        $this->expectException(ActionForbiddenException::class);

        $vo = $this->getValueObject([
            'foo' => 'bar',
        ]);

        unset($vo['foo']);
    }

    /**
     * @dataProvider toArrayData
     */
    public function testToArray(array $values, array $expected)
    {
        $this->assertSame(
            $expected,
            $this->getValueObject($values)->toArray()
        );
    }

    public function toArrayData(): array
    {
        return [
            [
                'values' => [],
                'expected' => [
                    'foo' => null,
                    'bar' => null,
                ],
            ],
            [
                'values' => [
                    'foo' => 'bar',
                ],
                'expected' => [
                    'foo' => 'bar',
                    'bar' => null,
                ],
            ],
            [
                'values' => [
                    'notExisting' => 'foo bar'
                ],
                'expected' => [
                    'foo' => null,
                    'bar' => null,
                    'notExisting' => 'foo bar',
                ],
            ],
            [
                'values' => [
                    'notExisting' => 'foo bar',
                    'bar' => 'foo',
                ],
                'expected' => [
                    'foo' => null,
                    'bar' => 'foo',
                    'notExisting' => 'foo bar',
                ],
            ],
        ];
    }

    private function getValueObject(array $values)
    {
        return new class ($values) extends ValueObject {
            protected $validators = ValueObjectTest::VALIDATORS;
            protected $keys = ValueObjectTest::KEYS;
        };
    }
}
