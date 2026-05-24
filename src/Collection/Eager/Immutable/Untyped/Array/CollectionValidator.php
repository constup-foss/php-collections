<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class CollectionValidator implements CollectionValidatorInterface
{
    /**
     * @inheritDoc
     */
    public function validateArrayIsList(array $items): void
    {
        if (!array_is_list($items)) {
            throw new CollectionValidationException()
                ->arrayIsNotAList();
        }
    }
}
