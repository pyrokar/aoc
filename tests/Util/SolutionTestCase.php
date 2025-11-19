<?php

declare(strict_types=1);

namespace AOCTest\Util;

use AOC\Util\Position2D;
use Generator;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Safe\Exceptions\FilesystemException;

use function fgets;
use function Safe\fclose;
use function Safe\fopen;
use function trim;

abstract class SolutionTestCase extends TestCase
{
    /**
     * @var class-string of callable
     */
    protected string $solutionClass;

    protected function tearDown(): void
    {
        Position2D::resetY();
    }

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
        $solutionProvider = new ($this->solutionClass);

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

    /**
     * @throws FilesystemException
     */
    protected function generatorFromFileNoTrim(string $filename): Generator
    {
        $file = fopen($filename, 'rb');
        try {
            while ($line = fgets($file)) {
                yield $line;
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
