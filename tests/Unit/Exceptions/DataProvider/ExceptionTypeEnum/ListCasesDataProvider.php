<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\ExceptionTypeEnum;

readonly class ListCasesDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'All cases are listed.' => [
                'expected' => [
                    'validation_error',
                    'failed',
                    'unhandled',
                ],
            ],
        ];
    }
}
