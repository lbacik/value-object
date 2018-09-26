<?php

declare(strict_types=1);

namespace Tests\Sushi;

use PHPUnit\Framework\TestCase;
use Sushi\Validator\InitializeValidator;
use Sushi\Validator\KeysValidator;
use Sushi\ValueObject\ValidatorList;
use Sushi\ValueObject\ValidatorList\Exceptions\NotAValidatorException;

class ValidatorListTest extends TestCase
{
    public function testInstantiate(): void
    {
        $vl = new ValidatorList();

        $this->assertInstanceOf(ValidatorList::class, $vl);
    }

    public function testInstantiateStatic(): void
    {
        $vl = ValidatorList::create();

        $this->assertInstanceOf(ValidatorList::class, $vl);
    }

    public function testAddValidator(): void
    {
        $vl = ValidatorList::create();
        $vl->addValidatorClass(KeysValidator::class);

        $this->assertInstanceOf(KeysValidator::class, $vl->current());
    }

    public function testAddNotAValidatorClass(): void
    {
        $this->expectException(NotAValidatorException::class);

        $vl = ValidatorList::create();
        $vl->addValidatorClass(ValidatorList::class);
    }

    public function testIterator(): void
    {
        $vl = ValidatorList::create();
        $vl->addValidatorClass(KeysValidator::class);
        $vl->addValidatorClass(InitializeValidator::class);

        $validatorArray = [];
        foreach ($vl as $validator) {
            $validatorArray[] = $validator;
        }

        $this->assertInstanceOf(KeysValidator::class, $validatorArray[0]);
        $this->assertInstanceOf(InitializeValidator::class, $validatorArray[1]);
    }
}
