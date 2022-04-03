<?php

declare(strict_types=1);

namespace Tests\Sushi;

use Sushi\ValueObject;
use Sushi\ValueObject\Exceptions\ValueObjectException;
use Sushi\ValueObject\Invariant;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\ExpectationFailedException;
use TypeError;

use function PHPUnit\Framework\assertGreaterThan;

class ValueObjectReadOnlyTest extends TestCase
{
    private ValueObject $valueObject;

    public function setUp(): void
    {
        $this->valueObject = new class (
            name: "foo",
            value: 12
        ) extends ValueObject {
            public function __construct(
                public readonly string $name,
                public readonly int $value,
            ) {
                parent::__construct();
            }

            #[Invariant]
            public function intValue(): void
            {
                assertGreaterThan(10, $this->value);
            }
        };
    }

    public function testIsEqual()
    {
        $copy = $this->valueObject->set();
        $this->assertTrue($this->valueObject->isEqual($copy));
    }

    public function testNotEqual()
    {
        $newObj = $this->valueObject->set(name: "bar");
        $this->assertFalse($this->valueObject->isEqual($newObj));
    }

    public function testAssignNewField()
    {
        $this->expectException(ValueObjectException::class);
        $this->expectExceptionCode(ValueObjectException::FIELD_NOT_FOUND);

        $this->valueObject->set(nameBar: "bar");
    }

    public function testAssignWrongType(): void
    {
        $this->expectException(TypeError::class);

        $this->valueObject->set(name: 10);
    }

    public function testInvariantRule(): void
    {
        $this->expectException(ExpectationFailedException::class);

        $this->valueObject->set(value: 0);
    }
}
