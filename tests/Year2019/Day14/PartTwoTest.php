<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day14;

use AOC\Year2019\Day14\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

final class PartTwoTest extends SolutionTestCase
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test_1')], 82892753],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 5586022],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_3')], 460664],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 1120408],
        ];
    }
}
