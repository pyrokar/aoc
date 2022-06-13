<?php declare(strict_types=1);

namespace AOC\Util\Safe;

use Safe\Exceptions\FilesystemException;

/**
 * @template T of object
 * @extends \ReflectionClass<T>
 */
class ReflectionClass extends \ReflectionClass
{
    /**
     * @throws FilesystemException
     */
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
