<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\TypeValidator\TestSamples;

enum SampleEnum implements SampleEnumInterface
{
    case FOO;
    case BAR;
}
