<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

readonly class CountDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Valid data.' => [
                'items' => ['foo', 'bar', 'baz'],
                'expected' => 3,
            ],
        ];
    }
}
