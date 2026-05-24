<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\TestSamples\SampleClass;

readonly class GetIteratorDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Simple array.' => [
                'items' => ['item1', 'item2'],
            ],
            'Empty array.' => [
                'items' => [],
            ],
        ];
    }

    public static function provide_foreach_HappyFlow(): array
    {
        return [
            'getIterator() should work when foreach is used. Array of typed objects.' => [
                'items' => [
                    new SampleClass('foo', 42),
                    new SampleClass('bar', 43),
                    new SampleClass('baz', 44),
                ],
            ],
        ];
    }
}
