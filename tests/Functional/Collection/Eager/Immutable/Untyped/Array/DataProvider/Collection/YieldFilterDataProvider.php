<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

use ArrayIterator;

class YieldFilterDataProvider
{
    public static function provide_IterateOverInternalArray_HappyFlow(): array
    {
        return [
            'Multiple items - some pass the filter.' => [
                'items' => ['a', 'b', 'c', 'd'],
                'filterMap' => ['a' => true, 'b' => false, 'c' => true, 'd' => false],
                'expectedYielded' => ['a', 'c'],
            ],
            'All items pass the filter.' => [
                'items' => ['x', 'y'],
                'filterMap' => ['x' => true, 'y' => true],
                'expectedYielded' => ['x', 'y'],
            ],
            'No items pass the filter.' => [
                'items' => ['x', 'y'],
                'filterMap' => ['x' => false, 'y' => false],
                'expectedYielded' => [],
            ],
            'Single item passes.' => [
                'items' => ['only'],
                'filterMap' => ['only' => true],
                'expectedYielded' => ['only'],
            ],
            'Single item does not pass.' => [
                'items' => ['only'],
                'filterMap' => ['only' => false],
                'expectedYielded' => [],
            ],
            'Empty collection.' => [
                'items' => [],
                'filterMap' => [],
                'expectedYielded' => [],
            ],
        ];
    }

    public static function provide_PassedIterable_HappyFlow(): array
    {
        return [
            'Custom array iterable overrides collection items.' => [
                'items' => ['ignored1', 'ignored2'],
                'iterable' => ['x', 'y', 'z'],
                'filterMap' => ['x' => false, 'y' => true, 'z' => true],
                'expectedYielded' => ['y', 'z'],
            ],
            'Custom ArrayIterator iterable.' => [
                'items' => ['ignored'],
                'iterable' => new ArrayIterator(['p', 'q', 'r']),
                'filterMap' => ['p' => true, 'q' => false, 'r' => true],
                'expectedYielded' => ['p', 'r'],
            ],
            'Custom empty iterable - callable is never called despite non-empty collection.' => [
                'items' => ['a', 'b'],
                'iterable' => [],
                'filterMap' => [],
                'expectedYielded' => [],
            ],
        ];
    }
}
