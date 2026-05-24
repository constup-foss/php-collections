<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

interface CollectionValidatorInterface
{
    /**
     * Validates that the given array is a sequential list.
     *
     * @param array $items
     *
     * @throws CollectionValidationException
     *
     * @return void
     *
     * @see CollectionValidationException::arrayIsNotAList()
     */
    public function validateArrayIsList(
        array $items,
    ): void;
}
