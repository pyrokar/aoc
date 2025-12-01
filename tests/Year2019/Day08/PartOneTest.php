<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day08;

use AOC\Year2019\Day08\PartOne;
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
            [['123456789012', 3, 2], 1],
            [[$this->lineFromFile(__DIR__ . DS . 'input'), 25, 6], 1965],
        ];
    }
}
