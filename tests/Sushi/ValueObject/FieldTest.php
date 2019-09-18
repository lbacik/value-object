<?php

declare(strict_types=1);

namespace Tests\Sushi\ValueObject;

use PHPUnit\Framework\TestCase;
use Sushi\ValueObject;

class FieldTest extends TestCase
{
    public function testToArray(): void
    {
        $vo = $this->createVOClass($array = ['foo' => 'bar']);
        $this->assertSame($array, $vo->toArray());
    }

    public function testToArrayDeep(): void
    {
        $foo = $this->createVOClass($fooArr = ['foo' => 'bar']);
        $bar = $this->createVOClass(['bar' => $foo]);

        $this->assertSame(['bar' => $fooArr], $bar->toArray());
    }

    private function createVOClass(array $data): ValueObject
    {
        return new class($data) extends ValueObject
        {
        };
    }
}
