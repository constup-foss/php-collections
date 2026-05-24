<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class WithoutItemDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Removing an item from the collection must remove it from the array. New collection instance must be returned.' => [
                'items' => ['foo', 'bar', 'baz'],
                'index' => 1,
                'expected' => ['foo', 'baz'],
            ],
            'Removes the last item.' => [
                'items' => ['foo'],
                'index' => 0,
                'expected' => [],
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Item with provided index does not exist. Exception is thrown.' => [
                'items' => ['foo', 'bar', 'baz'],
                'index' => $index = 3,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 3,
            ],
            'Collection is empty.' => [
                'items' => [],
                'index' => $index = 0,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 3,
            ],
        ];
    }
}
