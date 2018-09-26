<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;

use Sushi\Validator\KeysValidator;
use Sushi\ValueObject;
use Sushi\Validator\Exceptions\NotExistingKeyException as ValidatorNotExistingKeyException;

class EmptyValidateValueObjectTest extends TestCase
{
    const VALIDATORS = [
        KeysValidator::class,
    ];

    public function testInstantiate(): void
    {
        $vo = $this->getValueObject([]);

        $this->assertInstanceOf(ValueObject::class, $vo);
    }

    public function testInstantiateWithNotExistingKey(): void
    {
        $this->expectException(ValidatorNotExistingKeyException::class);

        $this->getValueObject([
            'notExisting' => 1,
        ]);
    }

    public function testGetNotExistingKey(): void
    {
        $vo = $this->getValueObject([]);

        $this->assertSame(null, $vo['notExisting']);
    }

    /**
     * @dataProvider toArrayData
     */
    public function testToArray(array $values, array $expected): void
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
                'expected' => [],
            ],
        ];
    }

    private function getValueObject(array $values)
    {
        return new class ($values) extends ValueObject {
            protected $validators = EmptyValidateValueObjectTest::VALIDATORS;
        };
    }
}
