<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

readonly class WithItemDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Simple array.' => [
                'items' => ['foo', 'bar', 'baz'],
                'value' => 'fee',
                'expected' => ['foo', 'bar', 'baz', 'fee'],
            ],
        ];
    }
}
