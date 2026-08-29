<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Untyped;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionFactory;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidator;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidatorInterface;
use ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Untyped\DataProvider\CollectionFactory\ConstructorDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class CollectionFactoryTest extends TestCase
{
    #[DataProviderExternal(ConstructorDataProvider::class, 'provide_HappyFlow')]
    public function test_construct_HappyFlow(
        ?CollectionValidatorInterface $collectionValidator,
        CollectionValidatorInterface $expected,
    ): void {
        $collectionFactory = new CollectionFactory($collectionValidator);
        $reflectionProperty = new ReflectionProperty($collectionFactory, 'collectionValidator');
        $reflectionCollectionValidator = $reflectionProperty->getValue($collectionFactory);

        $this->assertEquals($expected, $reflectionCollectionValidator);
    }

    public function test_constructor_noValidatorProvided(): void
    {
        $collectionFactory = new CollectionFactory();
        $reflectionProperty = new ReflectionProperty($collectionFactory, 'collectionValidator');
        $reflectionCollectionValidator = $reflectionProperty->getValue($collectionFactory);
        $expected = new CollectionValidator();

        $this->assertEquals($expected, $reflectionCollectionValidator);
    }
}
