<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day02;

use AOC\Year2016\Day02\PartOne;
use AOC\Test\Util\SolutionTest;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTest
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], '1985'],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], '24862'],
        ];
    }
}
