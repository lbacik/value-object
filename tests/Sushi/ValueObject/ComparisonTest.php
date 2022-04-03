<?php

declare(strict_types=1);

namespace Tests\Sushi\ValueObject;

use Sushi\ValueObject;
use PHPUnit\Framework\TestCase;

class ComparisonTest extends TestCase
{
    /**
     * @dataProvider comparisonData
     */
    public function testIsEqual(ValueObject $vo1, ValueObject $vo2, bool $expected): void
    {
        $this->assertSame($expected, $vo1->isEqual($vo2));
    }

    public function comparisonData(): array
    {
        return [
            [
                new ValueObject(),
                new ValueObject(),
                true,
            ],
            [
                new ValueObject(),
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                    ) {
                        parent::__construct();
                    }
                },
                false,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                    ) {
                        parent::__construct();
                    }
                },
                true,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                        public readonly bool $global = false,
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                    ) {
                        parent::__construct();
                    }
                },
                false,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                        public readonly bool $global = false,
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                        public readonly int $global = 0,
                    ) {
                        parent::__construct();
                    }
                },
                false,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                        public readonly bool $global = false,
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                        public readonly bool $global = true,
                    ) {
                        parent::__construct();
                    }
                },
                false,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                        public readonly bool $global = false,
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly string $name = 'foo',
                        public readonly bool $global = false,
                    ) {
                        parent::__construct();
                    }
                },
                true,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly ValueObject $name = new ValueObject(),
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly ValueObject $name = new ValueObject(),
                    ) {
                        parent::__construct();
                    }
                },
                true,
            ],
//            [
//                new class () extends ValueObject {
//                    public function __construct(
//                        public readonly ValueObject $name,
//                    ) {
//                        parent::__construct();
//                    }
//                },
//                new class () extends ValueObject {
//                    public function __construct(
//                        public readonly ValueObject $name = new ValueObject(),
//                    ) {
//                        parent::__construct();
//                    }
//                },
//                true,
//            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [],
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [],
                    ) {
                        parent::__construct();
                    }
                },
                true,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [1, 2],
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [2, 1],
                    ) {
                        parent::__construct();
                    }
                },
                false,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [1, 2],
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [1, 2],
                    ) {
                        parent::__construct();
                    }
                },
                true,
            ],
            [
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [1 => 'a', 2 => 'b'],
                    ) {
                        parent::__construct();
                    }
                },
                new class () extends ValueObject {
                    public function __construct(
                        public readonly array $values = [2 => 'b', 1 => 'a'],
                    ) {
                        parent::__construct();
                    }
                },
                true,
            ],
        ];
    }
}
