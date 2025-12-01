<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day20;

use AOC\Year2016\Day20\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use PHPUnit\Framework\Attributes\Small;
use Safe\Exceptions\FilesystemException;

#[Small]
class PartOneTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartOne::class;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 3],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 23923783],
        ];
    }
}
