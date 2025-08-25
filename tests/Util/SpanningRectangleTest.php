<?php

declare(strict_types=1);

namespace AOCTest\Util;

use AOC\Util\SpanningRectangle;
use PHPUnit\Framework\TestCase;

class SpanningRectangleTest extends TestCase
{
    public function testGrowX(): void
    {
        $rectangle = new SpanningRectangle(0, 0);

        $rectangle->growX(2);

        $this->assertEquals(0, $rectangle->x);
        $this->assertEquals(2, $rectangle->width);

        $rectangle->growX(-2);

        $this->assertEquals(-2, $rectangle->x);
        $this->assertEquals(4, $rectangle->width);
    }

    public function testGrowY(): void
    {
        $rectangle = new SpanningRectangle(0, 0);

        $rectangle->growY(2);

        $this->assertEquals(0, $rectangle->y);
        $this->assertEquals(2, $rectangle->height);

        $rectangle->growY(-2);

        $this->assertEquals(-2, $rectangle->y);
        $this->assertEquals(4, $rectangle->height);

    }
}
