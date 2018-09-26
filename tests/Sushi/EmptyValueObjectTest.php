<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use Sushi\ValueObject;
use Sushi\ValueObject\Exceptions\ActionForbiddenException;

class EmptyValueObjectTest extends TestCase
{
    public function testInstantiate(): void
    {
        $vo = new ValueObject([]);

        $this->assertInstanceOf(ValueObject::class, $vo);
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
        $vo1 = new ValueObject([]);

        $vo2 = $vo1->set([
            'foo' => 1,
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo2);
        $this->assertSame($vo2['foo'], 1);
    }

    public function testSetMulti(): void
    {
        $vo1 = new ValueObject([]);

        $vo2 = $vo1->set([
            'foo' => 'bar',
            'bar' => 1,
        ]);

        $this->assertInstanceOf(ValueObject::class, $vo2);
        $this->assertSame($vo2['foo'], 'bar');
        $this->assertSame($vo2['bar'], 1);
    }

    public function testDirectSet(): void
    {
        $this->expectException(ActionForbiddenException::class);

        $vo = new ValueObject([]);

        $vo['foo'] = 'bar';
    }

    public function testDirectSetWhenPassed(): void
    {
        $this->expectException(ActionForbiddenException::class);

        $vo = new ValueObject([
            'foo' => 'bar',
        ]);

        $vo['foo'] = 'foo';
    }

    public function testDirectUnSet(): void
    {
        $this->expectException(ActionForbiddenException::class);

        $vo = new ValueObject([]);

        unset($vo['foo']);
    }

    public function testDirectUnSetWhenPassed(): void
    {
        $this->expectException(ActionForbiddenException::class);

        $vo = new ValueObject([
            'foo' => 'bar',
        ]);

        unset($vo['foo']);
    }

    /**
     * @dataProvider toArrayData
     */
    public function testToArray(array $values, array $expected): void
    {
        $vo = new ValueObject($values);

        $this->assertSame($expected, $vo->toArray());
    }

    public function toArrayData(): array
    {
        return [
            [
                'values' => [],
                'expected' => [],
            ],
            [
                'values' => [
                    'foo' => 'bar',
                ],
                'expected' => [
                    'foo' => 'bar',
                ],
            ],
            [
                'values' => [
                    'foo' => 'foo bar',
                    'bar' => 'foo',
                ],
                'expected' => [
                    'foo' => 'foo bar',
                    'bar' => 'foo',
                ],
            ],
        ];
    }
}
