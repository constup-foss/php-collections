<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

use ArrayIterator;
use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;
use IteratorAggregate;
use Traversable;

readonly class MergeDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Merge array with array.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'iterable' => ['fee', 'fi', 'fo'],
                'expected' => ['foo', 'bar', 'baz', 'fee', 'fi', 'fo'],
            ],
            'Merge array with IteratorAggregate.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
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
                'type' => 'string',
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
                'type' => 'string',
                'secondCollectionItems' => ['fee', 'fi', 'fo'],
                'expected' => ['foo', 'bar', 'baz', 'fee', 'fi', 'fo'],
            ],
            'Merge with empty collection.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'secondCollectionItems' => [],
                'expected' => ['foo', 'bar', 'baz'],
            ],
            'Merge empty collection with another simple array collection.' => [
                'items' => [],
                'type' => 'string',
                'secondCollectionItems' => ['fee', 'fi', 'fo'],
                'expected' => ['fee', 'fi', 'fo'],
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Merge incompatible types. Merge with array.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'iterable' => [1, 2, 3],
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 1,
            ],
            'Merge incompatible types. Merge with array. Only one element in second array has incompatible type.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'iterable' => ['fi', null, 'fo'],
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 1,
            ],
            'Merge incompatible types. Merge with Iterator.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'iterable' => new ArrayIterator([1, 2, 3]),
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 1,
            ],
            'Merge incompatible types. Merge with IteratorAggregate.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'iterable' => new class() implements IteratorAggregate {
                    public function getIterator(): Traversable
                    {
                        return new ArrayIterator([1, 2, 3]);
                    }
                },
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 1,
            ],
        ];
    }
}
