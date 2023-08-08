<?php

declare(strict_types=1);

namespace AOC\Test\Util;

use AOC\Util\Safe\ReflectionClass;
use Generator;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Safe\Exceptions\FilesystemException;

use function Safe\fclose;
use function Safe\fopen;
use function Safe\define;

define('DS', DIRECTORY_SEPARATOR);

abstract class SolutionTest extends TestCase
{
    /**
     * @var class-string of callable
     */
    protected string $solutionClass;

    /**
     * @return array<mixed>
     */
    abstract public function data(): array;

    /**
     * @throws ReflectionException
     * @throws FilesystemException
     *
     * @return void
     */
    public function test(): void
    {
        $data = $this->data();

        if (empty($data)) {
            $this->expectNotToPerformAssertions();
            return;
        }

        /** @var callable $solutionProvider */
        $solutionProvider = new ($this->solutionClass)();

        /**
         * @var  array<mixed> $args
         * @var  mixed $expected
         */
        foreach ($data as [$args, $expected]) {
            $this->assertEquals($expected, $solutionProvider(...$args));
        }
    }

    /**
     * @throws FilesystemException
     */
    protected function generatorFromFile(string $filename): Generator
    {
        $file = fopen($filename, 'rb');
        try {
            while ($line = fgets($file)) {
                yield trim($line);
            }
        } finally {
            fclose($file);
        }
    }

    protected function generatorFromString(string $input): Generator
    {
        yield $input;
    }

    /**
     * @throws FilesystemException
     */
    protected function lineFromFile(string $filename): string
    {
        $file = fopen($filename, 'rb');
        $line = trim(fgets($file) ?: '');
        fclose($file);

        return $line;
    }
}
