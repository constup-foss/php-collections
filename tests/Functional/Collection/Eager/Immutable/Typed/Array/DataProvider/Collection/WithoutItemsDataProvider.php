<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class WithoutItemsDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Valid array of indexes.' => [
                'items' => ['foo', 'bar', 'baz', 'fee', 'fi', 'fo'],
                'type' => 'string',
                'indexes' => [0, 2, 4],
                'expected' => ['bar', 'fee', 'fo'],
            ],
            'Empty array of indexes.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'indexes' => [],
                'expected' => ['foo', 'bar', 'baz'],
            ],
            'Removes all items.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'indexes' => [0, 1, 2],
                'expected' => [],
            ],
            'Both collection and indexes are empty.' => [
                'items' => [],
                'type' => 'string',
                'indexes' => [],
                'expected' => [],
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Invalid index.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'indexes' => [0, 2, $errorIndex = 4],
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 3,
            ],
            'Collection is empty.' => [
                'items' => [],
                'type' => 'string',
                'indexes' => [0, 1, 2],
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 3,
            ],
        ];
    }
}
