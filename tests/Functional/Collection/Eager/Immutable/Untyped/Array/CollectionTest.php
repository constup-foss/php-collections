<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\Collection;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidator;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidatorInterface;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\ClearDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\ConstructDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\CountDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\GetItemsDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\GetIteratorDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\MergeDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\ReplaceItemDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\SwapItemsDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\WithItemDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\WithoutItemDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\WithoutItemsDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\YieldEachDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\YieldFilterDataProvider;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection\YieldRawItemsDataProvider;
use Generator;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    private CollectionValidatorInterface $collectionValidator;

    protected function setUp(): void
    {
        $this->collectionValidator = new CollectionValidator();
    }

    #[DataProviderExternal(
        ConstructDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_construct_HappyFlow(
        array $items,
        int $expectedCount
    ): void {
        $collection = new Collection($items, $this->collectionValidator);

        $this->assertEquals($expectedCount, count($collection->items));
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        ConstructDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_construct_ErrorFlow(
        array $items,
        string $expectedException,
        int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionCode($expectedExceptionCode);

        new Collection($items, $this->collectionValidator);
    }

    #[DataProviderExternal(
        GetIteratorDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_getIterator_HappyFlow(
        array $items,
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $result = $collection->getIterator();
        $this->assertEquals($items, $result->getArrayCopy());
    }

    #[DataProviderExternal(
        GetItemsDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_getItems_HappyFlow(
        array $items,
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $result = $collection->getItems();
        $this->assertEquals($items, $result);
    }

    #[DataProviderExternal(
        CountDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_count_HappyFlow(
        array $items,
        int $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $result = count($collection);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        GetIteratorDataProvider::class,
        'provide_foreach_HappyFlow'
    )]
    public function test_getIterator_foreach_HappyFlow(
        array $items,
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $result = [];
        foreach ($collection as $key => $item) {
            $result[$key] = $item;
        }
        $this->assertEquals($items, $result);
    }

    #[DataProviderExternal(
        WithItemDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_withItem_HappyFlow(
        array $items,
        mixed $value,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->withItem($value);
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        MergeDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_merge_HappyFlow(
        array $items,
        iterable $iterable,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->merge($iterable);
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        MergeDataProvider::class,
        'provide_WithCollection_HappyFlow'
    )]
    public function test_merge_WithCollection_HappyFlow(
        array $items,
        array $secondCollectionItems,
        array $expected
    ): void {
        $secondCollection = new Collection($secondCollectionItems, $this->collectionValidator);
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->merge($secondCollection);
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        WithoutItemDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_withoutItem_HappyFlow(
        array $items,
        int $index,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->withoutItem($index);
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        WithoutItemDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_withoutItem_ErrorFlow(
        array $items,
        int $index,
        string $expectedException,
        int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionCode($expectedExceptionCode);

        $collection = new Collection($items, $this->collectionValidator);
        $collection->withoutItem($index);
    }

    #[DataProviderExternal(
        WithoutItemsDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_withoutItems_HappyFlow(
        array $items,
        array $indexes,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->withoutItems($indexes);
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        WithoutItemsDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_withoutItems_ErrorFlow(
        array $items,
        array $indexes,
        string $expectedException,
        int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionCode($expectedExceptionCode);

        $collection = new Collection($items, $this->collectionValidator);
        $collection->withoutItems($indexes);
    }

    #[DataProviderExternal(
        ReplaceItemDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_replaceItem_HappyFlow(
        array $items,
        int $index,
        mixed $value,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->replaceItem($index, $value);
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        ReplaceItemDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_replaceItem_ErrorFlow(
        array $items,
        int|string $index,
        mixed $value,
        string $expectedException,
        int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionCode($expectedExceptionCode);

        $collection = new Collection($items, $this->collectionValidator);
        $collection->replaceItem($index, $value);
    }

    #[DataProviderExternal(
        SwapItemsDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_swapItems_HappyFlow(
        array $items,
        int $firstItemIndex,
        int $secondItemIndex,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->swapItems($firstItemIndex, $secondItemIndex);
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        SwapItemsDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_swapItems_ErrorFlow(
        array $items,
        int $firstItemIndex,
        int $secondItemIndex,
        string $expectedException,
        int $expectedExceptionCode
    ): void {
        $this->expectException($expectedException);
        $this->expectExceptionCode($expectedExceptionCode);

        $collection = new Collection($items, $this->collectionValidator);
        $collection->swapItems($firstItemIndex, $secondItemIndex);
    }

    #[DataProviderExternal(
        ClearDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_clear_HappyFlow(
        array $items,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $newCollection = $collection->clear();
        $result = $newCollection->items;

        $this->assertEquals($expected, $result);
        $this->assertEquals($items, $collection->items);
    }

    #[DataProviderExternal(
        YieldRawItemsDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_yieldRawItems(
        array $items,
        array $expected
    ): void {
        $collection = new Collection($items, $this->collectionValidator);
        $result = $collection->yieldRawItems();

        $this->assertEquals($expected, iterator_to_array($result));
    }

    #[DataProviderExternal(
        YieldEachDataProvider::class,
        'provide_IterateOverInternalArray_HappyFlow'
    )]
    public function test_yieldEach_IterateOverInternalArray_HappyFlow(
        array $items,
    ): void {
        $receivedArguments = [];
        $callable = function (mixed $item) use (&$receivedArguments): string {
            $receivedArguments[] = $item;

            return 'result_' . $item;
        };

        $collection = new Collection($items, $this->collectionValidator);
        $result = iterator_to_array($collection->yieldEach($callable));

        $this->assertCount(count($items), $receivedArguments);
        $this->assertEquals($items, $receivedArguments);

        $expectedResults = array_map(
            static fn (mixed $item): string => 'result_' . $item,
            $items,
        );
        $this->assertEquals($expectedResults, $result);
    }

    #[DataProviderExternal(
        YieldEachDataProvider::class,
        'provide_PassedIterable_HappyFlow'
    )]
    public function test_yieldEach_PassedIterable_HappyFlow(
        array $items,
        iterable $iterable,
    ): void {
        $receivedArguments = [];
        $callable = function (mixed $item) use (&$receivedArguments): string {
            $receivedArguments[] = $item;

            return 'result_' . $item;
        };

        $collection = new Collection($items, $this->collectionValidator);
        $result = iterator_to_array($collection->yieldEach($callable, $iterable));

        $iterableAsArray = iterator_to_array((function () use ($iterable): Generator {
            yield from $iterable;
        })());

        $this->assertCount(count($iterableAsArray), $receivedArguments);
        $this->assertEquals(array_values($iterableAsArray), $receivedArguments);

        $expectedResults = array_map(
            static fn (mixed $item): string => 'result_' . $item,
            $iterableAsArray,
        );
        $this->assertEquals($expectedResults, $result);
    }

    #[DataProviderExternal(
        YieldFilterDataProvider::class,
        'provide_IterateOverInternalArray_HappyFlow'
    )]
    public function test_yieldFilter_IterateOverInternalArray_HappyFlow(
        array $items,
        array $filterMap,
        array $expectedYielded,
    ): void {
        $receivedArguments = [];
        $callable = function (mixed $item) use (&$receivedArguments, $filterMap): bool {
            $receivedArguments[] = $item;

            return $filterMap[$item];
        };

        $collection = new Collection($items, $this->collectionValidator);
        $result = iterator_to_array($collection->yieldFilter($callable), preserve_keys: false);

        $this->assertCount(count($items), $receivedArguments);
        $this->assertEquals($items, $receivedArguments);
        $this->assertEquals($expectedYielded, $result);
    }

    #[DataProviderExternal(
        YieldFilterDataProvider::class,
        'provide_PassedIterable_HappyFlow'
    )]
    public function test_yieldFilter_PassedIterable_HappyFlow(
        array $items,
        iterable $iterable,
        array $filterMap,
        array $expectedYielded,
    ): void {
        $receivedArguments = [];
        $callable = function (mixed $item) use (&$receivedArguments, $filterMap): bool {
            $receivedArguments[] = $item;

            return $filterMap[$item];
        };

        $collection = new Collection($items, $this->collectionValidator);
        $result = iterator_to_array($collection->yieldFilter($callable, $iterable), preserve_keys: false);

        $iterableAsArray = iterator_to_array((function () use ($iterable): Generator {
            yield from $iterable;
        })());

        $this->assertCount(count($iterableAsArray), $receivedArguments);
        $this->assertEquals(array_values($iterableAsArray), $receivedArguments);
        $this->assertEquals($expectedYielded, $result);
    }
}
