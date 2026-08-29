<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class CollectionFactory
{
    /**
     * @var CollectionValidatorInterface
     */
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
