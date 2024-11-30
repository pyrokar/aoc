<?php

declare(strict_types=1);

namespace AOCTest\Year2016\Day06;

use AOCTest\Util\SolutionTestCase;
use AOC\Year2016\Day06\PartOne;
use Safe\Exceptions\FilesystemException;

class PartOneTest extends SolutionTestCase
{
    protected string $solutionClass = PartOne::class;

    /**
     * @inheritDoc
     *
     * @throws FilesystemException
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 'easter'],
            [[$this->generatorFromFile(__DIR__ . DS . 'input')], 'ygjzvzib'],
        ];
    }
}
