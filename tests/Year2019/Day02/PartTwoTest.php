<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day02;

use AOC\Year2019\Day02\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;
use PHPUnit\Framework\Attributes\Group;
use Safe\Exceptions\FilesystemException;

#[Group('intcodecomputer')]
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
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 9820],
        ];
    }
}
