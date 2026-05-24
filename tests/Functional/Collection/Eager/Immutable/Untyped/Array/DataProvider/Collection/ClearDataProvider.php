<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

readonly class ClearDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'New instance with an empty array must be returned.' => [
                'items' => ['foo', 'bar', 'baz'],
                'expected' => [],
            ],
        ];
    }
}
