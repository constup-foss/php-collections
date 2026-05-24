<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class SwapItemsDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Valid indexes.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'firstItemIndex' => 0,
                'secondItemIndex' => 1,
                'expected' => ['bar', 'foo', 'baz'],
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'First item index is invalid.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'firstItemIndex' => $index = 100,
                'secondItemIndex' => 1,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 3,
            ],
            'Second item index is invalid.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'firstItemIndex' => 1,
                'secondItemIndex' => 100,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 3,
            ],
            'Both indexes are the same.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'firstItemIndex' => 1,
                'secondItemIndex' => 1,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 4,
            ],
        ];
    }
}
