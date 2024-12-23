<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day13;

use AOC\Year2019\Day13\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

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
    #[Override]
    public function data(): array
    {
        return [
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 12952],
        ];
    }
}
