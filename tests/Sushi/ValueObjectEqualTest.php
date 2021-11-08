<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;
use Sushi\ValueObject;

class ValueObjectEqualTest extends TestCase
{
    public function testEmptyObjects()
    {
        $foo = new ValueObject([]);
        $bar = new ValueObject([]);

        $this->assertTrue($foo->isEqual($bar));
    }

    public function testScalars()
    {
        $foo = new ValueObject([
            'foo' => 'bar',
            'bar' => 1,
            'f' => 3.14,
        ]);
        $bar = new ValueObject([
            'foo' => 'bar',
            'bar' => 1,
            'f' => 3.14,
        ]);

        $this->assertTrue($foo->isEqual($bar));
    }

    public function testScalars1()
    {
        $foo = new ValueObject([
            'bar' => 1,
            'foo' => 'bar',
        ]);
        $bar = new ValueObject([
            'foo' => 'bar',
            'bar' => 1,
        ]);

        $this->assertTrue($foo->isEqual($bar));
    }

    public function testScalars2()
    {
        $foo = new ValueObject([
            'foo' => 'bar',
            'bar' => 1,
        ]);
        $bar = new ValueObject([
            'foo' => 'bar',
        ]);

        $this->assertFalse($foo->isEqual($bar));
    }

    public function testScalars3()
    {
        $foo = new ValueObject([
            'foo' => 'bar',
        ]);
        $bar = new ValueObject([
            'foo' => 'bar',
            'bar' => 1,
        ]);

        $this->assertFalse($foo->isEqual($bar));
    }

    public function testArrays()
    {
        $foo = new ValueObject([
            'foo' => [1, 2, 3],
            'bar' => [
                'a' => 1,
                'b' => 2,
            ],
        ]);
        $bar = new ValueObject([
            'foo' => [1, 2, 3],
            'bar' => [
                'b' => 2,
                'a' => 1,
            ],
        ]);

        $this->assertTrue($foo->isEqual($bar));
    }

    public function testObjects()
    {
        $obj = new() \stdClass();

        $foo = new ValueObject([
            'foo' => $obj,
        ]);
        $bar = new ValueObject([
            'foo' => $obj,
        ]);

        $this->assertTrue($foo->isEqual($bar));
    }

    public function testObjects2()
    {
        $foo = new ValueObject([
            'foo' => new() \stdClass(),
        ]);
        $bar = new ValueObject([
            'foo' => new() \stdClass(),
        ]);

        $this->assertFalse($foo->isEqual($bar));
    }

    public function testValueObject()
    {
        $vo1 = new ValueObject([
            'bar' => 1,
        ]);

        $vo2 = new ValueObject([
            'bar' => 1,
        ]);

        $foo = new ValueObject([
            'foo' => $vo1,
        ]);
        $bar = new ValueObject([
            'foo' => $vo2,
        ]);

        $this->assertTrue($foo->isEqual($bar));
    }

    public function testValueObject2()
    {
        $vo1 = new ValueObject([
            'bar' => 1,
        ]);

        $vo2 = new ValueObject([
            'bar' => 2,
        ]);

        $foo = new ValueObject([
            'foo' => $vo1,
        ]);
        $bar = new ValueObject([
            'foo' => $vo2,
        ]);

        $this->assertFalse($foo->isEqual($bar));
    }
}
