<?php

declare(strict_types=1);

namespace AOCTest\Year2024\Day23;

use AOC\Year2024\Day23\PartTwo;
use AOCTest\Util\SolutionTestCase;
use Safe\Exceptions\FilesystemException;

final class PartTwoTest extends SolutionTestCase
{
    /** @var class-string */
    public string $solutionClass = PartTwo::class;


    /**
     * @throws FilesystemException
     *
     * @return array<int, array<mixed>>
     */
    #[\Override]
    public function data(): array
    {
        return [
            [[$this->generatorFromFile(__DIR__ . DS . 'test')], 'co,de,ka,ta'],
            //[[$this->generatorFromFile(__DIR__ . DS . 'input')], 'ab,al,cq,cr,da,db,dr,fw,ly,mn,od,py,uh'],
        ];
    }
}
