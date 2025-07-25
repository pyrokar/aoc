<?php

declare(strict_types=1);

namespace AOCTest\Year2015\Day06;

use AOC\Year2015\Day06\PartTwo;
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
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromString('turn on 0,0 through 0,0')], 1],
            [[$this->generatorFromString('toggle 0,0 through 999,999')], 2000000],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 17836115],
        ];
    }
}
