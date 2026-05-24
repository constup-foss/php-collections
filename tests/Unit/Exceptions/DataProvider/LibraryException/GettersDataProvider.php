<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\LibraryException;

readonly class GettersDataProvider
{
    public static function provide_HappyFlow(): iterable
    {
        yield 'Debug message is set.' => [
            'type' => 'validation_error',
            'debugMessage' => 'The provided item is invalid.',
        ];

        yield 'Debug message is null.' => [
            'type' => 'failed',
            'debugMessage' => null,
        ];
    }
}
