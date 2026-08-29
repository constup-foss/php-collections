<?php

declare(strict_types=1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Untyped\DataProvider\Collection;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidator;

readonly class ConstructorDataProvider
{
    public static function provide_HappyFlow(): array {
        return [
            'Collection validator is provided.' => [
                'items' => [],
                'collectionValidator' => $collectionValidator = new CollectionValidator(),
                'expected' => $collectionValidator,
            ],
            'null is provided.' => [
                'items' => [],
                'collectionValidator' => null,
                'expected' => new CollectionValidator(),
            ],
        ];
    }
}