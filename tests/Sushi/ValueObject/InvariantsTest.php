<?php

declare(strict_types=1);

namespace Tests\Sushi\ValueObject;

use Sushi\ValueObject;
use Sushi\ValueObject\Exceptions\InvariantException;
use Sushi\ValueObject\Invariant;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertGreaterThan;
use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertNotEmpty;

class InvariantsTest extends TestCase
{
    private ValueObject $vo;

    public function setUp(): void
    {
        $this->vo = new class (
            name: "foo",
            value: 20,
        ) extends ValueObject {
            public function __construct(
                public readonly string $name,
                public readonly int $value,
            ) {
                parent::__construct();
            }

            #[Invariant]
            protected function checkName(): void
            {
                assertNotEmpty($this->name);
                assertGreaterThan(2, strlen($this->name));
            }

            #[Invariant]
            protected function checkValue(): void
            {
                assertGreaterThanOrEqual(20, $this->value);
            }

            #[Invariant]
            protected function checkGeneralRule(): void
            {
                if ($this->value > 100) {
                    throw InvariantException::violation("Value can't be greater than 100!");
                }
            }
        };
    }

    public function testSet(): void
    {
        $vo = $this->vo->set(name: "bar", value: 99);
        $this->assertInstanceOf(ValueObject::class, $vo);
    }

    public function testSetPartial(): void
    {
        $vo = $this->vo->set(value: 99);
        $this->assertInstanceOf(ValueObject::class, $vo);
    }

    public function testGeneralRule(): void
    {
        $this->expectException(InvariantException::class);
        $this->vo->set(value: 110);
    }

    public function testValueCheck(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->vo->set(value: 10);
    }

    public function testNameCheck(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->vo->set(name: "a");
    }

    public function testNameAndValueCheck(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->vo->set(name: "a", value: 10);
    }

    public function testNameAndValueCheckWhenValueIsCorrect(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->vo->set(name: "a", value: 30);
    }

    public function testNameAndValueCheckWhenNameIsCorrect(): void
    {
        $this->expectException(ExpectationFailedException::class);
        $this->vo->set(name: "ab", value: 10);
    }
}
