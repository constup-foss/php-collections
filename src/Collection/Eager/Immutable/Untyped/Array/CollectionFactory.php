<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class CollectionFactory
{
    private CollectionValidatorInterface $collectionValidator;

    /**
     * @param CollectionValidatorInterface|null $collectionValidator
     */
    public function __construct(
        ?CollectionValidatorInterface $collectionValidator = null,
    ) {
        $this->collectionValidator = $collectionValidator ?? new CollectionValidator();
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
