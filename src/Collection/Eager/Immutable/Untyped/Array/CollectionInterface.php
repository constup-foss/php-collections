<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array;

use InvalidArgumentException;
use Traversable;

/**
 * Collection encapsulating a sequential array.
 *      - Immutable.
 *      - Supports array-like access, but only for reading.
 *      - Countable.
 *      - Eager.
 *      - Intended to be used through composition in concrete, typed collections.
 *      - If used directly, there is no type safety.
 */
interface CollectionInterface
{
    /**
     * `items` getter. Implemented only for better IDE support.
     *
     * @return array<int, mixed>
     */
    public function getItems(): array;

    /**
     * Adds a value to the collection. Value will be added at the end of the collection.
     * Note that the collection is immutable, so this method will return a new instance with the added value.
     *
     * @param mixed $value The value to add.
     *
     * @return CollectionInterface
     */
    public function withItem(mixed $value): CollectionInterface;

    /**
     * Merges another iterable (`array|Traversable`, including other collections) into this one.
     * Note that the collection is immutable, so this method will return a new instance with the merged collection.
     *
     * @param iterable $iterable
     *
     * @throws InvalidArgumentException If the collection types do not match.
     *
     * @return CollectionInterface
     */
    public function merge(iterable $iterable): CollectionInterface;

    /**
     * Removes an item from the collection.
     * Note that the collection is immutable, so this method will return a new instance without the removed item.
     *
     * @param int $index
     *
     * @return CollectionInterface
     */
    public function withoutItem(int $index): CollectionInterface;

    /**
     * Removes multiple items from the collection with provided indexes.
     * Note that the collection is immutable, so this method will return a new instance without the removed items.
     *
     * @param array<int> $indexes The indexes of the items to remove.
     *
     * @return CollectionInterface
     */
    public function withoutItems(array $indexes): CollectionInterface;

    /**
     * Replaces an item in the collection at the specified index with the new value.
     * Note that the collection is immutable, so this method will return a new instance with the replaced item.
     *
     * @param int   $index
     * @param mixed $value
     *
     * @return CollectionInterface
     */
    public function replaceItem(int $index, mixed $value): CollectionInterface;

    /**
     * Swaps two items in the collection at the specified indexes.
     * Note that the collection is immutable, so this method will return a new instance with the items swapped.
     *
     * @param int $firstItemIndex
     * @param int $secondItemIndex
     *
     * @return CollectionInterface
     */
    public function swapItems(int $firstItemIndex, int $secondItemIndex): CollectionInterface;

    /**
     * Sets items to an empty array.
     * Note that the collection is immutable, so it will return a new instance with the data set to an empty array.
     *
     * @return CollectionInterface
     */
    public function clear(): CollectionInterface;

    /**
     * Returns a Generator that yields raw items from the collection.
     *
     * @return Traversable
     */
    public function yieldRawItems(): Traversable;

    /**
     * Yields each item after applying the provided callable.
     * If iterable is provided, it will iterate over it, instead of the raw items array from the collection.
     * Example:
     *      `$collection = new Collection([1, 2, 3]);`
     *      `$step1 = $collection->yieldEach(fn ($x) => $x * 2);`
     *      `$step2 = $collection->yieldEach(fn ($x) => $x + 1, $step1);`
     *      `foreach ($step2 as $value) { echo $value . PHP_EOL; }`
     *      `// Output: 3 5 7`
     *
     * @param callable      $callable
     * @param iterable|null $iterable
     *
     * @return Traversable
     */
    public function yieldEach(callable $callable, ?iterable $iterable = null): Traversable;

    /**
     * Returns a Generator that yields each item that satisfies the filter from the provided callable.
     * If iterable is provided, it will iterate over it, instead of the raw items array from the collection.
     * Example:
     *      `$collection = new Collection([1, 2, 3]);`
     *      `$step1 = $collection->yieldEach(fn ($x) => $x * 2);`
     *      `$step2 = $collection->yieldFilter(fn ($x) => $x > 2, $step1);`
     *      `$step3 = $collection->yieldEach(fn ($x) => $x + 1, $step2);`
     *      `foreach ($step2 as $value) { echo $value . PHP_EOL; }`
     *      `// Output: 5 7`
     *
     * @param callable      $callable
     * @param iterable|null $iterable
     *
     * @return Traversable
     */
    public function yieldFilter(callable $callable, ?iterable $iterable = null): Traversable;
}
