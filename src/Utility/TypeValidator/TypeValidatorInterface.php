<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Utility\TypeValidator;

interface TypeValidatorInterface
{
    /**
     * Checks if the given value is of the given type.
     *
     * Works with scalars, nulls, objects, typed objects, arrays, resources, and callables.
     * Will return `true` if a typed object is compared against `object`.
     * Will return `true` if a typed object is compared against the name of one of its parents or interfaces.
     * Will return `true` if an enum is compared against `object`.
     * Will return `true` if an enum object is compared against the name of one of its interfaces.
     *
     * @param mixed  $value
     * @param string $type
     *
     * @return bool
     */
    public function assertType(mixed $value, string $type): bool;
}
