<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array;

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
     * @param array  $items
     * @param string $type
     *
     * @throws CollectionValidationException
     *
     * @return Collection
     */
    public function produce(
        array $items,
        string $type
    ): Collection {
        return new Collection(
            $items,
            $type,
            $this->collectionValidator
        );
    }
}
