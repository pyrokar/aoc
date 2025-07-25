<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day02;

use AOC\Year2019\Day02\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;
use PHPUnit\Framework\Attributes\Group;

#[Group('intcodecomputer')]
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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 3500],
            [[$this->generatorFromFile(__DIR__ . DS . 'input'), [1 => 12, 2 => 2]], 2782414],
        ];
    }
}
