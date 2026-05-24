<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Functional\Collection\Eager\Immutable\Untyped\Array\TestSamples;

use Iterator;

class SampleIteratorClass implements Iterator
{
    private int $position;
    private array $sampleArray;
    
    public function __construct(
    ) {
        $this->position = 0;
    }

    public function add(mixed $value): self
    {
        $this->sampleArray[] = $value;

        return $this;
    }

    public function current(): mixed
    {
        return $this->sampleArray[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->sampleArray[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
