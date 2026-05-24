<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

readonly class MergeDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Merge array with array.' => [
                'items' => ['foo', 'bar', 'baz'],
                'iterable' => ['fee', 'fi', 'fo'],
                'expected' => ['foo', 'bar', 'baz', 'fee', 'fi', 'fo'],
            ],
            'Merge array with IteratorAggregate.' => [
                'items' => ['foo', 'bar', 'baz'],
                'iterable' => new class() implements IteratorAggregate {
                    public function getIterator(): Traversable
                    {
                        return new ArrayIterator(['fee', 'fi', 'fo']);
                    }
                },
                'expected' => ['foo', 'bar', 'baz', 'fee', 'fi', 'fo'],
            ],
            'Merge array with Iterator.' => [
                'items' => ['foo', 'bar', 'baz'],
                'iterable' => new ArrayIterator(['fee', 'fi', 'fo']),
                'expected' => ['foo', 'bar', 'baz', 'fee', 'fi', 'fo'],
            ],
        ];
    }

    public static function provide_WithCollection_HappyFlow(): array
    {
        return [
            'Simple array. Merge with another collection.' => [
                'items' => ['foo', 'bar', 'baz'],
                'secondCollectionItems' => ['fee', 'fi', 'fo'],
                'expected' => ['foo', 'bar', 'baz', 'fee', 'fi', 'fo'],
            ],
            'Merge with empty collection.' => [
                'items' => ['foo', 'bar', 'baz'],
                'secondCollectionItems' => [],
                'expected' => ['foo', 'bar', 'baz'],
            ],
            'Merge empty collection with another simple array collection.' => [
                'items' => [],
                'secondCollectionItems' => ['fee', 'fi', 'fo'],
                'expected' => ['fee', 'fi', 'fo'],
            ],
        ];
    }
}
