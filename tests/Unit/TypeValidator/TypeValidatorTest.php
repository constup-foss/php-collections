<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\TypeValidator;

use ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\DataProvider\TypeValidator\AssertTypeDataProvider;
use ConstupFoss\PhpCollections\Utility\TypeValidator\TypeValidator;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class TypeValidatorTest extends TestCase
{
    #[DataProviderExternal(
        AssertTypeDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_isOfType_HappyFlow(
        mixed $value,
        string $type,
        bool $expected
    ): void {
        $result = new TypeValidator()->assertType($value, $type);

        $this->assertEquals($expected, $result);
    }

    public function test_isOfType_Resource_HappyFlow(): void
    {
        $resource = fopen('php://memory', 'r+');

        try {
            $result = new TypeValidator()->assertType($resource, 'resource');
            $this->assertTrue($result);
        } finally {
            fclose($resource);
        }
    }
}
