<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day13;

use AOC\Year2019\Day13\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

/**
 * @large
 */
final class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;


    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 12952],
        ];
    }
}