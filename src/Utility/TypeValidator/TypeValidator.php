<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Utility\TypeValidator;

readonly class TypeValidator implements TypeValidatorInterface
{
    /**
     * @inheritDoc
     */
    public function assertType(
        mixed $value,
        string $type
    ): bool {
        return match ($type) {
            'string' => is_string($value),
            'int' => is_int($value),
            'float' => is_float($value),
            'bool' => is_bool($value),
            'array' => is_array($value),
            'null' => is_null($value),
            'callable' => is_callable($value),
            'iterable' => is_iterable($value),
            'resource' => is_resource($value),
            'object' => is_object($value),
            default => is_a($value, $type),
        };
    }
}
