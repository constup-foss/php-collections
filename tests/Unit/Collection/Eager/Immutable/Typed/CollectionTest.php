<?php

declare(strict_types=1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Typed;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\Collection;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\CollectionValidator;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\CollectionValidatorInterface;
use ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Typed\DataProvider\Collection\ConstructorDataProvider;
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
        string $type,
        ?CollectionValidatorInterface $collectionValidator,
        CollectionValidatorInterface $expected,
    ): void {
        $collection = new Collection($items, $type, $collectionValidator);
        $reflectionProperty = new ReflectionProperty($collection, 'collectionValidator');
        $reflectionCollectionValidator = $reflectionProperty->getValue($collection);

        $this->assertEquals($expected, $reflectionCollectionValidator);
    }

    public function test_constructor_noValidatorProvided_HappyFlow(): void {
        $collection = new Collection([], 'string');

        $reflectionProperty = new ReflectionProperty($collection, 'collectionValidator');
        $reflectionCollectionValidator = $reflectionProperty->getValue($collection);
        $expected = new CollectionValidator();

        $this->assertEquals($expected, $reflectionCollectionValidator);
    }
}