<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

class YieldRawItemsDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Simple array.' => [
                'items' => ['item1', 'item2'],
                'expected' => ['item1', 'item2'],
            ],
            'Empty array.' => [
                'items' => [],
                'expected' => [],
            ],
        ];
    }
}
