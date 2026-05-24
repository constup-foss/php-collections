<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Exceptions;

use ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\LibraryException\GettersDataProvider;
use ConstupFoss\PhpCollections\Tests\Unit\Exceptions\TestSamples\LibraryExceptionTestStub;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class LibraryExceptionTest extends TestCase
{
    #[DataProviderExternal(
        GettersDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_getters_HappyFlow(
        string $type,
        ?string $debugMessage,
    ): void {
        $exception = new LibraryExceptionTestStub($type, $debugMessage);

        $this->assertSame($type, $exception->getType());
        $this->assertSame($debugMessage, $exception->getDebugMessage());
        $this->assertSame('constup/php-collections', $exception->getLibraryName());
    }
}
