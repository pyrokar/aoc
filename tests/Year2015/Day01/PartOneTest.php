<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day01;

use AOC\Year2015\Day01\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[Override]
    public function data(): array
    {
        return [
            [['(())'], 0],
            [['()()'], 0],
            [['((('], 3],
            [['(()(()('], 3],
            [['))((((('], 3],
            [['())'], -1],
            [['))('], -1],
            [[')))'], -3],
            [[')())())'], -3],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 232],
        ];
    }
}
