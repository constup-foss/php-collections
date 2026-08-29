<?php

declare(strict_types=1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Typed\DataProvider\CollectionValidator;

use ConstupFoss\PhpCollections\Utility\TypeValidator\TypeValidator;

readonly class ConstructorDataProvider
{
    public static function provide_HappyFlow(): array {
        return [
            'CollectionValidator is provided.' => [
                'typeValidator' => $typeValidator = new TypeValidator(),
                'expected' => $typeValidator,
            ],
            'null is provided.' => [
                'typeValidator' => null,
                'expected' => new TypeValidator(),
            ]
        ];
    }
}