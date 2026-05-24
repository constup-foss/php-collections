<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\Collection;

use ConstupFoss\PhpCollections\Exceptions\Exceptions\CollectionValidationException;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\TestSamples\AnotherSampleClass;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\TestSamples\SampleClass;
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
                'expectedCount' => 3,
            ],
            'Valid array of standard objects is passed.' => [
                'items' => [
                    new stdClass(),
                    new stdClass(),
                ],
                'expectedCount' => 2,
            ],
            'Valid array of strings is passed.' => [
                'items' => [
                    'foo',
                    'bar',
                    'baz',
                ],
                'expectedCount' => 3,
            ],
            'Valid array of different classes under the same interface is passed.' => [
                'items' => [
                    new SampleClass('foo', 42),
                    new AnotherSampleClass('bar'),
                ],
                'expectedCount' => 2,
            ],
            'Empty array is passed.' => [
                'items' => [],
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
                'expectedException' => CollectionValidationException::class,
                'expectedExceptionCode' => 2,
            ],
        ];
    }
}
