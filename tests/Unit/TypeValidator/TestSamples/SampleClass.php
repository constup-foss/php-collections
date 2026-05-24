<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples;

class SampleClass extends AbstractSampleClass implements SampleClassInterface
{
    public function __construct(
        public string $foo,
        public int $bar
    ) {
    }
}
