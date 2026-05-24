<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\TestSamples\SampleClass;

readonly class GetIteratorDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Simple array.' => [
                'items' => ['item1', 'item2'],
                'type' => 'string',
            ],
            'Empty array.' => [
                'items' => [],
                'type' => 'string',
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
                'type' => SampleClass::class,
            ],
        ];
    }
}
