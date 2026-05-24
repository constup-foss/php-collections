<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\TestSamples;

readonly class SampleClass implements SampleClassInterface
{
    public function __construct(
        public string $foo,
        public int $bar
    ) {
    }
}
