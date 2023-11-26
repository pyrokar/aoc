<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day04;

use AOC\Year2016\Day04\PartOne;
use AOCTest\Util\SolutionTest;
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
            [[$this->generatorFromString('aaaaa-bbb-z-y-x-123[abxyz]')], 123],
            [[$this->generatorFromString('a-b-c-d-e-f-g-h-987[abcde]')], 987],
            [[$this->generatorFromString('not-a-real-room-404[oarel]')], 404],
            [[$this->generatorFromString('totally-real-room-200[decoy]')], 0],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 361724],
        ];
    }
}
