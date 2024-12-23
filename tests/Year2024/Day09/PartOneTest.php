<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day09;

use AOC\Year2024\Day09\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

final class PartOneTest extends SolutionTestCase
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
            [[$this->lineFromFile(__DIR__ . DS . 'test')], 1928],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 6241633730082],
        ];
    }
}
