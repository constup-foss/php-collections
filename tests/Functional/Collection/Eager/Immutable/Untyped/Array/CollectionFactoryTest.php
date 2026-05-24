<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionFactory;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Untyped\Array\CollectionValidator;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\DataProvider\CollectionFactory\ProduceDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class CollectionFactoryTest extends TestCase
{
    #[DataProviderExternal(
        ProduceDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_produce_HappyFlow(
        array $items,
    ) {
        $collectionValidator = new CollectionValidator();

        $result = new CollectionFactory($collectionValidator)->produce($items);

        $this->assertSame($items, $result->items);

        $reflectionProperty = new ReflectionProperty($result, 'collectionValidator');
        $this->assertSame($collectionValidator, $reflectionProperty->getValue($result));
    }
}
