<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class CollectionFactory
{
    /**
     * @param CollectionValidatorInterface $collectionValidator
     */
    public function __construct(
        private CollectionValidatorInterface $collectionValidator,
    ) {
    }

    /**
     * @param array $items
     *
     * @throws CollectionValidationException
     *
     * @return Collection
     */
    public function produce(array $items): Collection
    {
        return new Collection($items, $this->collectionValidator);
    }
}
