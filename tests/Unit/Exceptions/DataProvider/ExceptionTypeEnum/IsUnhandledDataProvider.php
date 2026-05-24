<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\ExceptionTypeEnum;

use ConstupFoss\PhpCollections\Exceptions\ExceptionTypeEnum;

readonly class IsUnhandledDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'It is unhandled.' => [
                'enum' => ExceptionTypeEnum::UNHANDLED,
                'expected' => true,
            ],
            'Not unhandled.' => [
                'enum' => ExceptionTypeEnum::FAILED,
                'expected' => false,
            ],
        ];
    }
}
