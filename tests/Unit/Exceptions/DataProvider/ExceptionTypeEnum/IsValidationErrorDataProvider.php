<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\ExceptionTypeEnum;

use ConstupFoss\PhpCollections\Exceptions\ExceptionTypeEnum;

readonly class IsValidationErrorDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'It is a validation error.' => [
                'enum' => ExceptionTypeEnum::VALIDATION_ERROR,
                'expected' => true,
            ],
            'Not a validation error.' => [
                'enum' => ExceptionTypeEnum::FAILED,
                'expected' => false,
            ],
        ];
    }
}
