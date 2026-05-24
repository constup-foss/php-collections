<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Exceptions\Exceptions;

use ConstupFoss\PhpCollections\Exceptions\ExceptionTypeEnum;
use ConstupFoss\PhpCollections\Exceptions\LibraryException;

class CollectionValidationException extends LibraryException
{
    private const string VALIDATION_ERROR = 'Collection validation error.';
    private const string ARRAY_INDEX_ERROR = 'Array index error.';

    /**
     * Thrown when an item in the collection is not of the expected type.
     *
     * @param string $itemType
     * @param string $expectedType
     * @param int    $index
     *
     * @return $this
     */
    public function invalidItemTypeAtIndex(
        string $itemType,
        string $expectedType,
        int $index,
    ): self {
        $this->message = self::VALIDATION_ERROR;
        $this->code = 1;
        $this->type = ExceptionTypeEnum::VALIDATION_ERROR->value;
        $this->debugMessage = "Invalid item type at index: {$index}. Expected: {$expectedType}. Got: {$itemType}";

        return $this;
    }

    /**
     * Thrown when an array is not a sequential list.
     *
     * @return $this
     */
    public function arrayIsNotAList(): self
    {
        $this->message = self::VALIDATION_ERROR;
        $this->code = 2;
        $this->type = ExceptionTypeEnum::VALIDATION_ERROR->value;
        $this->debugMessage = 'Array is not a list.';

        return $this;
    }

    /**
     * Thrown when an index of the array is invalid.
     *
     * @param int $index
     *
     * @return $this
     */
    public function invalidIndex(int $index): self
    {
        $this->message = self::ARRAY_INDEX_ERROR;
        $this->code = 3;
        $this->type = ExceptionTypeEnum::FAILED->value;
        $this->debugMessage = "Invalid index: {$index}.";

        return $this;
    }

    /**
     * Thrown when attempting to swap two items with the same index.
     *
     * @param int $index
     *
     * @return $this
     */
    public function cannotSwapItemsWithSameIndex(int $index): self
    {
        $this->message = self::ARRAY_INDEX_ERROR;
        $this->code = 4;
        $this->type = ExceptionTypeEnum::FAILED->value;
        $this->debugMessage = "Cannot swap items with the same index: {$index}.";

        return $this;
    }
}
