<?php

declare(strict_types=1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Typed\DataProvider\Collection;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\CollectionValidator;

readonly class ConstructorDataProvider
{
    public static function provide_HappyFlow(): array {
        return [
            'Collection validator is provided.' => [
                'items' => [],
                'type' => 'string',
                'collectionValidator' => $collectionValidator = new CollectionValidator(),
                'expected' => $collectionValidator,
            ],
            'null is provided.' => [
                'items' => [],
                'type' => 'string',
                'collectionValidator' => null,
                'expected' => new CollectionValidator(),
            ],
        ];
    }
}