<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\DataProvider\TypeValidator;

use ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples\AbstractSampleClass;
use ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples\SampleClass;
use ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples\SampleClassInterface;
use ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples\SampleEnum;
use ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples\SampleEnumInterface;
use ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples\SomeOtherClass;
use Faker\Factory;

readonly class AssertTypeDataProvider
{
    public static function provide_HappyFlow(): array
    {
        $faker = Factory::create();

        return [
            'Value is string. Type is string.' => [
                'value' => $faker->word(),
                'type' => 'string',
                'expected' => true,
            ],
            'Value is string. Type is not string.' => [
                'value' => $faker->word(),
                'type' => 'int',
                'expected' => false,
            ],
            'Value is int. Type is int.' => [
                'value' => $faker->randomNumber(),
                'type' => 'int',
                'expected' => true,
            ],
            'Value is int. Type is not int.' => [
                'value' => $faker->randomNumber(),
                'type' => 'string',
                'expected' => false,
            ],
            'Value is float. Type is float.' => [
                'value' => $faker->randomFloat(),
                'type' => 'float',
                'expected' => true,
            ],
            'Value is float. Type is not float.' => [
                'value' => $faker->randomFloat(),
                'type' => 'int',
                'expected' => false,
            ],
            'Value is bool. Type is bool.' => [
                'value' => $faker->boolean(),
                'type' => 'bool',
                'expected' => true,
            ],
            'Value is bool. Type is not bool.' => [
                'value' => $faker->boolean(),
                'type' => 'string',
                'expected' => false,
            ],
            'Value is array. Type is array.' => [
                'value' => $faker->words(),
                'type' => 'array',
                'expected' => true,
            ],
            'Value is array. Type is not array.' => [
                'value' => $faker->words(),
                'type' => 'string',
                'expected' => false,
            ],
            'Value is null. Type is null.' => [
                'value' => null,
                'type' => 'null',
                'expected' => true,
            ],
            'Value is null. Type is not null.' => [
                'value' => null,
                'type' => 'string',
                'expected' => false,
            ],
            'Value is callable. Type is callable.' => [
                'value' => function () {
                },
                'type' => 'callable',
                'expected' => true,
            ],
            'Value is callable. Type is not callable.' => [
                'value' => function () {
                },
                'type' => 'iterable',
                'expected' => false,
            ],
            'Value is iterable. Type is iterable.' => [
                'value' => $faker->words(),
                'type' => 'iterable',
                'expected' => true,
            ],
            'Value is iterable. Type is not iterable.' => [
                'value' => $faker->words(),
                'type' => 'callable',
                'expected' => false,
            ],
            'Value is object. Type is object.' => [
                'value' => (object)['foo' => $faker->word()],
                'type' => 'object',
                'expected' => true,
            ],
            'Value is object. Type is not object.' => [
                'value' => (object)['foo' => $faker->word()],
                'type' => 'array',
                'expected' => false,
            ],
            'Value is typed object. Type is a class name.' => [
                'value' => new SampleClass(
                    $faker->word(),
                    $faker->randomNumber()
                ),
                'type' => SampleClass::class,
                'expected' => true,
            ],
            'Value is typed object. Type is an object at all.' => [
                'value' => new SampleClass(
                    $faker->word(),
                    $faker->randomNumber()
                ),
                'type' => 'string',
                'expected' => false,
            ],
            'Value is typed object, checked against default object type' => [
                'value' => new SampleClass(
                    $faker->word(),
                    $faker->randomNumber()
                ),
                'type' => 'object',
                'expected' => true,
            ],
            'Value is typed object, checked against its interface' => [
                'value' => new SampleClass(
                    $faker->word(),
                    $faker->randomNumber()
                ),
                'type' => SampleClassInterface::class,
                'expected' => true,
            ],
            'Value is typed object, checked against its parent' => [
                'value' => new SampleClass(
                    $faker->word(),
                    $faker->randomNumber()
                ),
                'type' => AbstractSampleClass::class,
                'expected' => true,
            ],
            'Value is typed object, checked against some other existing class name' => [
                'value' => new SampleClass(
                    $faker->word(),
                    $faker->randomNumber()
                ),
                'type' => SomeOtherClass::class,
                'expected' => false,
            ],
            'Value is enum' => [
                'value' => SampleEnum::FOO,
                'type' => SampleEnum::class,
                'expected' => true,
            ],
            'Value is enum, checked against default object type' => [
                'value' => SampleEnum::FOO,
                'type' => 'object',
                'expected' => true,
            ],
            'Value is enum, checked against its interface' => [
                'value' => SampleEnum::FOO,
                'type' => SampleEnumInterface::class,
                'expected' => true,
            ],
        ];
    }
}
