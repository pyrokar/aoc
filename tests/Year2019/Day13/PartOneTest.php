<?php

declare(strict_types=1);

namespace AOCTest\Year2019\Day13;

use AOC\Year2019\Day13\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use PHPUnit\Framework\Attributes\Group;
use Safe\Exceptions\FilesystemException;

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
            [[$this->lineFromFile(__DIR__ . DS . 'input')], 260],
        ];
    }
}
