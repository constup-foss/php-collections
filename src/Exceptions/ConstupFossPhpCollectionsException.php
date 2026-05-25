<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpCollections\Exceptions;

use ConstupFoss\PhpExerr\Library\LibraryException;

abstract class ConstupFossPhpCollectionsException extends LibraryException
{
    protected string $libraryName = 'constup-foss/php-collections';
}
