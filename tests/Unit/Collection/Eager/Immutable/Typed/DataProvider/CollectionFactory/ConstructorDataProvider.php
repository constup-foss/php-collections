<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Typed\DataProvider\CollectionFactory;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\CollectionValidator;

readonly class ConstructorDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'CollectionValidator is provided.' => [
                'collectionValidator' => $collectionValidator = new CollectionValidator(),
                'expected' => $collectionValidator,
            ],
            'null is provided.' => [
                'collectionValidator' => null,
                'expected' => new CollectionValidator(),
            ],
        ];
    }
}
