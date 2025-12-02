<?php

declare(strict_types=1);

namespace AOCTest\Year2025\Day02;

use AOC\Year2025\Day02\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

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
            [[$this->lineFromFile(__DIR__ . DS . 'test')], 4174379265],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 41662374059],
        ];
    }
}
