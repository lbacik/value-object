<?php

declare(strict_types=1);

namespace Tests\Sushi\ValueObject;

use PHPUnit\Framework\TestCase;
use Sushi\ValueObject;

class FieldTest extends TestCase
{
    public function testToArray(): void
    {
        $vo = new ValueObject($array = ['foo' => 'bar']);
        $this->assertSame($array, $vo->toArray());
    }

    public function testToArrayDeep(): void
    {
        $foo = new ValueObject($fooArr = ['foo' => 'bar']);
        $bar = new ValueObject(['bar' => $foo]);

        $this->assertSame(['bar' => $fooArr], $bar->toArray());
    }
}
