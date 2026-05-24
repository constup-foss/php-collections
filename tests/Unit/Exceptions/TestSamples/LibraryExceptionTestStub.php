<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Tests\Unit\Exceptions\TestSamples;

use ConstupFoss\PhpCollections\Exceptions\LibraryException;

class LibraryExceptionTestStub extends LibraryException
{
    public function __construct(string $type, ?string $debugMessage)
    {
        parent::__construct();
        $this->type = $type;
        $this->debugMessage = $debugMessage;
    }
}
