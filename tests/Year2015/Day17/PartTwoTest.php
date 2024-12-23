<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day17;

use AOC\Year2015\Day17\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

/**
 * @small
 */
class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test'), 25], 3],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), 150], 17],
        ];
    }
}
