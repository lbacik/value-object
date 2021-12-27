<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;
use Sushi\ValueObject;
use Sushi\ValueObject\Exceptions\InvariantException;
use Sushi\ValueObject\Invariant;
use Sushi\ValueObjectDKeys;

class InvariantsTest extends TestCase
{
    public function testInvariants(): void
    {
        $vo = $this->createVoObject(10);
        $this->assertInstanceOf(ValueObject::class, $vo);
    }

    public function testInvariantViolation(): void
    {
        $this->expectException(InvariantException::class);
        $this->createVoObject(20);
    }

    private function createVoObject(int $number): ValueObject
    {
        return new class (number: $number) extends ValueObjectDKeys {
            #[Invariant]
            public function checkNumber(): void
            {
                if ($this->get('number') !== 10) {
                    throw InvariantException::violation('Wrong number');
                }
            }
        };
    }
}
