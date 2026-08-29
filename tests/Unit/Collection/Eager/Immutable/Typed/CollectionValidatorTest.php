<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Typed;

use ConstupFoss\PhpCollections\Collection\Eager\Immutable\Typed\Array\CollectionValidator;
use ConstupFoss\PhpCollections\Tests\Unit\Collection\Eager\Immutable\Typed\DataProvider\CollectionValidator\ConstructorDataProvider;
use ConstupFoss\PhpCollections\Utility\TypeValidator\TypeValidator;
use ConstupFoss\PhpCollections\Utility\TypeValidator\TypeValidatorInterface;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class CollectionValidatorTest extends TestCase
{
    #[DataProviderExternal(
        ConstructorDataProvider::class,
        'provide_happyFlow'
    )]
    public function test_constructor_HappyFlow(
        ?TypeValidatorInterface $typeValidator,
        TypeValidatorInterface $expected
    ): void {
        $collectionValidator = new CollectionValidator($typeValidator);
        $reflectionProperty = new ReflectionProperty($collectionValidator, 'typeValidator');
        $reflectionTypeValidator = $reflectionProperty->getValue($collectionValidator);

        $this->assertEquals($expected, $reflectionTypeValidator);
    }

    public function test_construct_noTypeValidatorProvided_HappyFlow(): void
    {
        $collectionValidator = new CollectionValidator();
        $reflectionProperty = new ReflectionProperty($collectionValidator, 'typeValidator');
        $reflectionTypeValidator = $reflectionProperty->getValue($collectionValidator);
        $expected = new TypeValidator();

        $this->assertEquals($expected, $reflectionTypeValidator);
    }
}
