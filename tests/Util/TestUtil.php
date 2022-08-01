<?php declare(strict_types=1);

namespace AOCTest\Util;

use AOC\Util\Safe\ReflectionClass;
use AOC\Util\SolutionInterface;
use Generator;
use ReflectionException;
use Safe\Exceptions\FilesystemException;

use function Safe\fclose;
use function Safe\fopen;

trait TestUtil
{
    /**
     * @throws ReflectionException|FilesystemException
     */
    public function testPartOneTestInput(): void
    {
        $this->testInput($this->partOneTestInput(), 'One');
    }

    /**
     * @throws ReflectionException|FilesystemException
     */
    public function testPartTwoTestInput(): void
    {
        $this->testInput($this->partTwoTestInput(), 'Two');
    }

    /**
     * @param array<int, array<mixed>> $inputs
     * @param string $part
     *
     * @throws FilesystemException
     * @throws ReflectionException
     */
    private function testInput(array $inputs, string $part): void
    {
        $method = 'solvePart' . $part;

        /** @var SolutionInterface $solutionProvider */
        $solutionProvider = new (static::$solutionClass)();

        $testClassReflector = new ReflectionClass($this);
        $dir = dirname($testClassReflector->getFileName());

        if (empty($inputs)) {
            $this->expectNotToPerformAssertions();
        }

        /**
         * @var  string $input
         * @var  mixed $output
         */
        foreach ($inputs as [$input, $output]) {
            if (!is_string($input)) {
                continue;
            }

            if (is_file($dir . DIRECTORY_SEPARATOR . $input)) {
                $input = self::getGeneratorFromFile($dir . DIRECTORY_SEPARATOR . $input);
            } else {
                $input = self::getGenerator([$input]);
            }

            $this->assertEquals($output, $solutionProvider->{$method}($input));
        }

        /*$solutionClassReflector = new ReflectionClass(static::$solutionClass);

        $filename = dirname($solutionClassReflector->getFileName()) . DIRECTORY_SEPARATOR . 'input.txt';

        $result = $solutionProvider->{$method}(self::getGeneratorFromFile($filename));

        echo 'Part ' . $part . ': ' . $result . "\n";*/
    }

    /**
     * @return array<int, array<mixed>>
     */
    public function partOneTestInput(): array
    {
        return [];
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

    /** @var array<resource> */
    private static array $openFiles = [];

    /**
     * @param string $filename
     *
     * @return Generator
     * @throws FilesystemException
     */
    private static function getGeneratorFromFile(string $filename): Generator
    {
        $file = fopen($filename, 'rb');
        self::$openFiles[] = $file;
        while (($line = fgets($file)) !== false) {
            yield $line;
        }
    }

    /**
     * @throws FilesystemException
     */
    public function __destruct()
    {
        foreach (self::$openFiles as $i => $openFile) {
            fclose($openFile);
            unset(self::$openFiles[$i]);
        }
    }
}
