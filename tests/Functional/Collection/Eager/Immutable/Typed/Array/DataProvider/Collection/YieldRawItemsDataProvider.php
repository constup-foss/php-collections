<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

class YieldRawItemsDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Simple array.' => [
                'items' => ['item1', 'item2'],
                'type' => 'string',
                'expected' => ['item1', 'item2'],
            ],
            'Empty array.' => [
                'items' => [],
                'type' => 'string',
                'expected' => [],
            ],
        ];
    }
}
