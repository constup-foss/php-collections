<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\TestSamples;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class SampleIteratorAggregateClass implements IteratorAggregate
{
    public function __construct(
        public array $sampleArray,
    ) {
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->sampleArray);
    }
}
