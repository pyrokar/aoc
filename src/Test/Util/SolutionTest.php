<?php

namespace AOC\Test\Util;

use AOC\Util\Safe\ReflectionClass;
use Generator;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Safe\Exceptions\FilesystemException;
use function Safe\fclose;
use function Safe\fopen;

abstract class SolutionTest extends TestCase
{
    protected string $solutionClass;

    /**
     * @return array<mixed>
     */
    abstract public function data(): array;

    /**
     * @return void
     * @throws ReflectionException
     * @throws FilesystemException
     */
    public function test(): void
    {
        $data = $this->data();

        if (empty($data)) {
            $this->expectNotToPerformAssertions();
            return;
        }

        $solutionProvider = new ($this->solutionClass)();

        $testClassReflector = new ReflectionClass($this);
        $dir = dirname($testClassReflector->getFileName());

        /**
         * @var  array<mixed> $args
         * @var  mixed $expected
         */
        foreach ($data as [$args, $expected]) {
            $input = array_shift($args);

            if (!is_string($input)) {
                continue;
            }

            if (is_file($dir . DIRECTORY_SEPARATOR . $input)) {
                $input = self::getGeneratorFromFile($dir . DIRECTORY_SEPARATOR . $input);
            } else {
                $input = self::getGenerator([$input]);
            }

            $this->assertEquals($expected, $solutionProvider($input, ...$args));
        }
    }

    /**
     * @param array<mixed> $values
     *
     * @return Generator
     */
    private static function getGenerator(array $values): Generator
    {
        foreach ($values as $value) {
            yield $value;
        }
    }

    /**
     * @param string $filename
     *
     * @return Generator
     * @throws FilesystemException
     */
    private static function getGeneratorFromFile(string $filename): Generator
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
}
