<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day15;

use AOC\Year2024\Day15\PartOne;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;
use Override;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 2028],
            [[$this->generatorFromFile(__DIR__ . DS . 'test_2')], 10092],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')],1318523],
        ];
    }
}
