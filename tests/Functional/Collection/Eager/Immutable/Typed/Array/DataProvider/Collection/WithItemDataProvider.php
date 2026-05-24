<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

readonly class WithItemDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Simple array.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'value' => 'fee',
                'expected' => ['foo', 'bar', 'baz', 'fee'],
            ],
        ];
    }
}
