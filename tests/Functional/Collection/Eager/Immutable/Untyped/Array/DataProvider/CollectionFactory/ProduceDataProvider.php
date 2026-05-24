<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\CollectionFactory;

class ProduceDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Happy flow' => [
                'items' => ['foo', 'bar', 'baz'],
            ],
        ];
    }
}
