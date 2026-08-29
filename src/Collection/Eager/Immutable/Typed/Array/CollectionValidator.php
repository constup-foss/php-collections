<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;
use ConstupFoss\PhpCollections\Utility\TypeValidator\TypeValidator;
use ConstupFoss\PhpCollections\Utility\TypeValidator\TypeValidatorInterface;

readonly class CollectionValidator implements CollectionValidatorInterface
{
    private TypeValidatorInterface $typeValidator;

    /**
     * @param TypeValidatorInterface|null $typeValidator
     */
    public function __construct(
        ?TypeValidatorInterface $typeValidator = null
    ) {
        $this->typeValidator = $typeValidator ?? new TypeValidator();
    }

    /**
     * @inheritDoc
     */
    public function validateItemTypes(
        array $items,
        string $type,
    ): void {
        foreach ($items as $index => $item) {
            if (!$this->typeValidator->assertType($item, $type)) {
                throw new CollectionValidationException()
                    ->invalidItemTypeAtIndex(get_debug_type($index), $type, $index);
            }
        }
    }

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
