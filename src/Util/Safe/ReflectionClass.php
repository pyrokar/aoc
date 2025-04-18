<?php

declare(strict_types=1);

namespace AOC\Util\Safe;

use Safe\Exceptions\FilesystemException;
use Override;

/**
 * @template T of object
 *
 * @extends \ReflectionClass<T>
 */
class ReflectionClass extends \ReflectionClass
{
    /**
     * @throws FilesystemException
     */
    #[Override]
    public function getFileName(): string
    {
        error_clear_last();
        $result = parent::getFileName();

        if ($result === false) {
            throw FilesystemException::createFromPhpError();
        }

        return $result;
    }
}
