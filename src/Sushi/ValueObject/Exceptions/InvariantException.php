<?php

declare(strict_types=1);

namespace Sushi\ValueObject\Exceptions;

use RuntimeException;

class InvariantException extends RuntimeException
{
    public static function violation(string $message): static
    {
        return new static("Invariant's violation! {$message}");
    }
}
