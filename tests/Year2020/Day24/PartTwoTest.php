<?php

declare(strict_types=1);

namespace AOCTest\Year2020\Day24;

use AOC\Year2020\Day24\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;
use PHPUnit\Framework\Attributes\Large;

#[Large]
class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;

    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     *
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 2208],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 3700],
        ];
    }
}
