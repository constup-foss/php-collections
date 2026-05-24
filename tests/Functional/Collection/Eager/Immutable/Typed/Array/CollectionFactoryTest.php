<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\CollectionFactory;
use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\CollectionValidator;
use ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\DataProvider\CollectionFactory\ProduceDataProvider;
use ConstupFoss\PhpCollections\Utility\TypeValidator\TypeValidator;
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
        string $type,
    ): void {
        $collectionValidator = new CollectionValidator(
            new TypeValidator()
        );

        $result = new CollectionFactory($collectionValidator)->produce($items, $type);

        $this->assertEquals($items, $result->items);
        $this->assertEquals($type, $result->type);

        $reflectionProperty = new ReflectionProperty($result, 'collectionValidator');
        $this->assertSame($collectionValidator, $reflectionProperty->getValue($result));
    }
}
