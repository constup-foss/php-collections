<?php

declare(strict_types=1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Untyped;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\Collection;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidator;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidatorInterface;
use ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Untyped\DataProvider\Collection\ConstructorDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class CollectionTest extends TestCase
{
    #[DataProviderExternal(
        ConstructorDataProvider::class,
        'provide_HappyFlow',
    )]
    public function test_constructor_HappyFlow(
        array $items,
        ?CollectionValidatorInterface $collectionValidator,
        CollectionValidatorInterface $expected,
    ): void {
        $collection = new Collection($items, $collectionValidator);
        $reflectionProperty = new ReflectionProperty($collection, 'collectionValidator');
        $reflectionCollectionValidator = $reflectionProperty->getValue($collection);

        $this->assertEquals($expected, $reflectionCollectionValidator);
    }

    public function test_constructor_noValidatorProvided_HappyFlow(): void {
        $collection = new Collection([]);

        $reflectionProperty = new ReflectionProperty($collection, 'collectionValidator');
        $reflectionCollectionValidator = $reflectionProperty->getValue($collection);
        $expected = new CollectionValidator();

        $this->assertEquals($expected, $reflectionCollectionValidator);
    }
}