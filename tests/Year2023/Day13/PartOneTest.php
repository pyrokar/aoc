<?php

declare(strict_types=1);

namespace AOCTest\Year2023\Day13;

use AOC\Year2023\Day13\PartOne;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

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
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 405],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 37718],
        ];
    }
}
