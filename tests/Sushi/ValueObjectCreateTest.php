<?php

declare(strict_types=1);

namespace Tests\Sushi;

use Sushi\ValueObject;
use PHPUnit\Framework\TestCase;

class ValueObjectCreateTest extends TestCase
{
    public function testCreateWithMoreParams(): void
    {
        $vo = $this->createValueObject("foo", "bar");

        $params = (function () {
            return array_keys($this->getValues());
        })->call($vo);

        $this->assertInstanceOf(ValueObject::class, $vo);
        $this->assertSame(['name'], $params);
        $this->assertSame('foo', $vo->name);
    }

    public function testCreateWithDefaults(): void
    {
        $vo = $this->createValueObject();

        $this->assertInstanceOf(ValueObject::class, $vo);
        $this->assertSame("foobar", $vo->name);
    }

    private function createValueObject(...$args): ValueObject
    {
        return new class (...$args) extends ValueObject {
            public function __construct(
                public readonly string $name = "foobar",
            ) {
                parent::__construct();
            }
        };
    }
}
