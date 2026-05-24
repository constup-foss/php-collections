<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\TestSamples\AnotherSampleClass;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\TestSamples\SampleClass;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\TestSamples\SampleClassInterface;
use stdClass;

readonly class ConstructDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Valid array of typed objects is passed.' => [
                'items' => [
                    new SampleClass('foo', 42),
                    new SampleClass('bar', 43),
                    new SampleClass('baz', 44),
                ],
                'type' => SampleClass::class,
                'expectedCount' => 3,
            ],
            'Valid array of standard objects is passed.' => [
                'items' => [
                    new stdClass(),
                    new stdClass(),
                ],
                'type' => stdClass::class,
                'expectedCount' => 2,
            ],
            'Valid array of strings is passed.' => [
                'items' => [
                    'foo',
                    'bar',
                    'baz',
                ],
                'type' => 'string',
                'expectedCount' => 3,
            ],
            'Valid array of different classes under the same interface is passed. Type is their interface.' => [
                'items' => [
                    new SampleClass('foo', 42),
                    new AnotherSampleClass('bar'),
                ],
                'type' => SampleClassInterface::class,
                'expectedCount' => 2,
            ],
            'Empty array is passed.' => [
                'items' => [],
                'type' => SampleClass::class,
                'expectedCount' => 0,
            ],
        ];
    }

    public static function provide_errorFlow(): array
    {
        return [
            'Associative array is passed.' => [
                'items' => [
                    'foo' => new SampleClass('foo', 42),
                    'bar' => new SampleClass('bar', 43),
                    'baz' => new SampleClass('baz', 44),
                ],
                'type' => SampleClass::class,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 2,
            ],
            'Invalid item type in array.' => [
                'items' => [
                    new SampleClass('foo', 42),
                    new stdClass(),
                    new SampleClass('baz', 44),
                ],
                'type' => SampleClass::class,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 1,
            ],
            'Two classes with same interface are passed. Type is matching only one of them.' => [
                'items' => [
                    new SampleClass('foo', 42),
                    new AnotherSampleClass('bar'),
                    new SampleClass('baz', 44),
                ],
                'type' => SampleClass::class,
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 1,
            ],
        ];
    }
}
