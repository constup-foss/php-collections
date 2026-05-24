<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Typed\Array\TestSamples;

readonly class AnotherSampleClass implements SampleClassInterface
{
    public function __construct(
        public string $foo,
    ) {
    }
}
