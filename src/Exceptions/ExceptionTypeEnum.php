<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Exceptions;

enum ExceptionTypeEnum: string
{
    case VALIDATION_ERROR = 'validation_error';
    case FAILED = 'failed';
    case UNHANDLED = 'unhandled';

    public function isValidationError(): bool
    {
        return $this === self::VALIDATION_ERROR;
    }

    public function isUnhandled(): bool
    {
        return $this === self::UNHANDLED;
    }

    public function isFailed(): bool
    {
        return $this === self::FAILED;
    }

    public static function listCases(): array
    {
        return array_column(self::cases(), 'value');
    }
}
