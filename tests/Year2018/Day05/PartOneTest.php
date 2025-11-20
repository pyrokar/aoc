<?php

declare(strict_types=1);

namespace AOCTest\Year2018\Day05;

use AOC\Year2018\Day05\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

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
            [[$this->lineFromFile(__DIR__ . DS . 'test')], 10],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 11636],
        ];
    }
}
