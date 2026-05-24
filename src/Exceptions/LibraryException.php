<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Exceptions;

use Exception;

/**
 * Exceptions thrown by `constup/php-collections` library.
 */
abstract class LibraryException extends Exception implements LibraryExceptionInterface
{
    protected string $type;
    protected ?string $debugMessage;
    protected string $libraryName = 'constup/php-collections';

    public function getType(): string
    {
        return $this->type;
    }

    public function getDebugMessage(): ?string
    {
        return $this->debugMessage;
    }

    public function getLibraryName(): string
    {
        return $this->libraryName;
    }
}
