<?php declare(strict_types=1);

namespace AOC\Util;

class Display2D
{
    /**
     * @var array<int, array<Point2D>>
     */
    private array $columns;

    /**
     * @var array<int, array<Point2D>>
     */
    private array $rows;

    public function __construct(
        readonly public int $width,
        readonly public int $height,
    ) {
        $this->columns = array_fill(0, $this->width, []);
        $this->rows = array_fill(0, $this->height, []);
    }

    public function set(int $x, int $y): void
    {
        $pixel = new Point2D($x, $y);
        $key = $pixel->getKey();

        $this->columns[$x][$key] = $pixel;
        $this->rows[$y][$key] = $pixel;
    }

    public function unset(int $x, int $y): void
    {
        $key = Point2D::key($x, $y);
        unset($this->columns[$x][$key], $this->rows[$y][$key]);
    }

    public function rotateColumn(int $x, int $by): void
    {
        $oldColumn = $this->columns[$x];

        foreach ($oldColumn as $pixel) {
            $this->unset($pixel->x, $pixel->y);
        }

        foreach ($oldColumn as $key => $pixel) {
            $this->set($x, ($pixel->y + $by) % $this->height);
        }
    }

    public function rotateRow(int $y, int $by): void
    {
        $oldRow = $this->rows[$y];

        foreach ($oldRow as $pixel) {
            $this->unset($pixel->x, $pixel->y);
        }
        foreach ($oldRow as $key => $pixel) {
            $this->set(($pixel->x + $by) % $this->width, $y);
        }
    }

    public function countPixels(): int
    {
        $count = 0;
        foreach ($this->rows as $row) {
            $count += count($row);
        }
        return $count;
    }

    public function __toString(): string
    {
        $output = '';
        for ($y = 0; $y < $this->height; ++$y) {
            for ($x = 0; $x < $this->width; ++$x) {
                if (isset($this->rows[$y][Point2D::key($x, $y)])) {
                    $output .= '#';
                } else {
                    $output .= '.';
                }
            }

            $output .= PHP_EOL;
        }

        return $output;
    }
}
