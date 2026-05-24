<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;

readonly class ReplaceItemDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Valid index and valid value provided.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'index' => 1,
                'value' => 'fee',
                'expected' => ['foo', 'fee', 'baz'],
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Invalid index.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'index' => 3,
                'value' => 'fee',
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 3,
            ],
            'Invalid value type.' => [
                'items' => ['foo', 'bar', 'baz'],
                'type' => 'string',
                'index' => 1,
                'value' => 123,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 1,
            ],
        ];
    }
}
