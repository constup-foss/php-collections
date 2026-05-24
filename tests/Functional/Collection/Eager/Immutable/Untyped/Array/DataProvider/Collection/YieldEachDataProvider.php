<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

use ArrayIterator;

class YieldEachDataProvider
{
    public static function provide_IterateOverInternalArray_HappyFlow(): array
    {
        return [
            'Multiple items.' => [
                'items' => ['a', 'b', 'c'],
            ],
            'Single item.' => [
                'items' => ['only'],
            ],
            'Empty collection' => [
                'items' => [],
            ],
        ];
    }

    public static function provide_PassedIterable_HappyFlow(): array
    {
        return [
            'Custom array iterable overrides collection items.' => [
                'items' => ['ignored1', 'ignored2'],
                'iterable' => ['x', 'y'],
            ],
            'Custom ArrayIterator iterable.' => [
                'items' => ['ignored'],
                'iterable' => new ArrayIterator(['p', 'q', 'r']),
            ],
            'Custom empty iterable - callable is never called despite non-empty collection.' => [
                'items' => ['a', 'b'],
                'iterable' => [],
            ],
        ];
    }
}
