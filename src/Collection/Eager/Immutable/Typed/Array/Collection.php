<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array;

use ArrayIterator;
use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;
use Countable;
use IteratorAggregate;
use Traversable;

readonly class Collection implements
    CollectionInterface,
    IteratorAggregate,
    Countable
{
    /**
     * @param array                        $items
     * @param string                       $type
     * @param CollectionValidatorInterface $collectionValidator
     *
     * @throws CollectionValidationException
     */
    public function __construct(
        public array $items,
        public string $type,
        private CollectionValidatorInterface $collectionValidator,
    ) {
        $this->collectionValidator->validateArrayIsList($this->items);
        $this->collectionValidator->validateItemTypes($this->items, $this->type);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Called once on:
     * - foreach ($collection as $key => $value)
     *
     * @return ArrayIterator<int, mixed>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @inheritDoc
     */
    public function withItem(mixed $value): Collection
    {
        $items = $this->items;
        $items[] = $value;

        return new Collection($items, $this->type, $this->collectionValidator);
    }

    /**
     * @inheritDoc
     */
    public function merge(iterable $iterable): Collection
    {
        return new Collection(
            [
                ...$this->items,
                ...iterator_to_array($iterable),
            ],
            $this->type,
            $this->collectionValidator
        );
    }

    /**
     * @inheritDoc
     */
    public function withoutItem(int $index): Collection
    {
        if (!isset($this->items[$index])) {
            throw new CollectionValidationException()
                ->invalidIndex($index);
        }

        $items = $this->items;
        unset($items[$index]);
        $items = array_values($items);

        return new Collection($items, $this->type, $this->collectionValidator);
    }

    /**
     * @inheritDoc
     */
    public function withoutItems(array $indexes): Collection
    {
        $items = $this->items;
        foreach ($indexes as $index) {
            if (!isset($items[$index])) {
                throw new CollectionValidationException()
                    ->invalidIndex($index);
            }
        }

        $temp = [];
        foreach ($this->items as $index => $item) {
            if (!in_array($index, $indexes)) {
                $temp[] = $item;
            }
        }

        return new Collection($temp, $this->type, $this->collectionValidator);
    }

    /**
     * @inheritDoc
     */
    public function replaceItem(int $index, mixed $value): Collection
    {
        if (!isset($this->items[$index])) {
            throw new CollectionValidationException()
                ->invalidIndex($index);
        }

        $items = $this->items;
        $items[$index] = $value;

        return new Collection($items, $this->type, $this->collectionValidator);
    }

    /**
     * @inheritDoc
     */
    public function swapItems(int $firstItemIndex, int $secondItemIndex): Collection
    {
        if ($firstItemIndex === $secondItemIndex) {
            throw new CollectionValidationException()
                ->cannotSwapItemsWithSameIndex($firstItemIndex);
        }

        if (!isset($this->items[$firstItemIndex])) {
            throw new CollectionValidationException()
                ->invalidIndex($firstItemIndex);
        }

        if (!isset($this->items[$secondItemIndex])) {
            throw new CollectionValidationException()
                ->invalidIndex($secondItemIndex);
        }

        $items = $this->items;
        $temp = $items[$firstItemIndex];
        $items[$firstItemIndex] = $items[$secondItemIndex];
        $items[$secondItemIndex] = $temp;

        return new Collection($items, $this->type, $this->collectionValidator);
    }

    /**
     * @inheritDoc
     */
    public function clear(): Collection
    {
        return new Collection([], $this->type, $this->collectionValidator);
    }

    /**
     * @inheritDoc
     */
    public function yieldRawItems(): Traversable
    {
        foreach ($this->items as $item) {
            yield $item;
        }
    }

    /**
     * @inheritDoc
     */
    public function yieldEach(callable $callable, ?iterable $iterable = null): Traversable
    {
        foreach ($iterable ?? $this->items as $item) {
            yield $callable($item);
        }
    }

    /**
     * @inheritDoc
     */
    public function yieldFilter(callable $callable, ?iterable $iterable = null): Traversable
    {
        foreach ($iterable ?? $this->items as $item) {
            if ($callable($item)) {
                yield $item;
            }
        }
    }
}
