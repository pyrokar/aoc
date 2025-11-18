<?php

declare(strict_types=1);

namespace AOCTest\Util;

use AOC\Util\Position2D;
use AOC\Util\SpanningRectangle;
use PHPUnit\Framework\TestCase;

class SpanningRectangleTest extends TestCase
{
    public function testAddPoint(): void
    {
        $sr = new SpanningRectangle();

        $p00 = new Position2D(0, 0);

        $this->assertFalse($sr->isPositionInside($p00));

        $p11 = new Position2D(1, 1);

        $sr->addPoint($p11);

        $this->assertFalse($sr->isPositionInside($p00));
        $this->assertTrue($sr->isPositionInside($p11));

        $p22 = new Position2D(2, 2);

        $sr->addPoint($p22);

        $this->assertFalse($sr->isPositionInside($p00));
        $this->assertTrue($sr->isPositionInside($p11));
        $this->assertTrue($sr->isPositionInside($p22));
    }
}
