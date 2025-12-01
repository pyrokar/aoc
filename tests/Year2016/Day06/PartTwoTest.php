<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day06;

use AOC\Year2016\Day06\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Override;
use Safe\Exceptions\FilesystemException;

class PartTwoTest extends SolutionTestCase
{
    protected string $solutionClass = PartTwo::class;

    /**
     * @inheritDoc
     *
     * @throws FilesystemException
     */
    #[Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 'advent'],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 'pdesmnoz'],
        ];
    }
}
