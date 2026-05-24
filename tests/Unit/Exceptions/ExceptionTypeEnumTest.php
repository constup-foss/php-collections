<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Exceptions;

use ConstupFoss\PhpCollections\Exceptions\ExceptionTypeEnum;
use ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\ExceptionTypeEnum\IsFailedDataProvider;
use ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\ExceptionTypeEnum\IsUnhandledDataProvider;
use ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\ExceptionTypeEnum\IsValidationErrorDataProvider;
use ConstupFoss\PhpCollections\Tests\Unit\Exceptions\DataProvider\ExceptionTypeEnum\ListCasesDataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class ExceptionTypeEnumTest extends TestCase
{
    #[DataProviderExternal(
        IsValidationErrorDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_isValidationError_HappyFlow(
        ExceptionTypeEnum $enum,
        bool $expected
    ): void {
        $result = $enum->isValidationError();
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        IsUnhandledDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_isUnhandled_HappyFlow(
        ExceptionTypeEnum $enum,
        bool $expected
    ): void {
        $result = $enum->isUnhandled();
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        IsFailedDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_isFailed_HappyFlow(
        ExceptionTypeEnum $enum,
        bool $expected
    ): void {
        $result = $enum->isFailed();
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        ListCasesDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_listCases_HappyFlow(
        array $expected
    ): void {
        $result = ExceptionTypeEnum::listCases();
        $this->assertCount(3, $result);
        $this->assertEquals($expected, $result);
    }
}
