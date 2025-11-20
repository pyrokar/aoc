<?php

declare(strict_types=1);

namespace AOCTest\Year2018\Day05;

use AOC\Year2018\Day05\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;
use PHPUnit\Framework\Attributes\Large;
use Safe\Exceptions\FilesystemException;

#[Large]
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
            [[$this->lineFromFile(__DIR__ . DS . 'test')], 4],
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 5302],
        ];
    }
}
