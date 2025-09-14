<?php

declare(strict_types=1);

namespace AOC\Year2019;

trait Debug
{
    /**
     * @var array<string, int>
     */
    protected array $columns = [
        'ip' => 4,
        'rb' => 4,
        'mod' => 3,
        'opc' => 8,
        'val1' => 17,
        'addr1' => 5,
        'val2' => 17,
        'addr2' => 5,
        'val3' => 17,
        'addr3' => 5,
    ];

    protected function _th(): void
    {
        if (!$this->debug) {
            return;
        }

        $width = array_sum($this->columns) + 3 * count($this->columns) + 1;

        $this->_n(str_repeat('-', $width));
        $headRow = '| ';
        foreach ($this->columns as $key => $value) {
            $headRow .= str_pad((string) $key, $value, ' ') . ' | ';
        }
        $this->_n($headRow);
        $this->_n(str_repeat('-', $width));
    }

    protected function _n(string $msg): void
    {
        if ($this->debug) {
            echo $msg . PHP_EOL;
        }
    }

    /**
     * @param array<string, string|int> $content
     *
     * @return void
     */
    protected function _td(array $content): void
    {
        if (!$this->debug) {
            return;
        }

        $width = array_sum($this->columns) + 3 * count($this->columns) + 1;

        $row = '| ';
        foreach ($this->columns as $key => $value) {

            $v = match ($key) {
                'ip' => $this->instructionPointer,
                'rb' => $this->relativeBase,
                default => $content[$key] ?? '',
            };

            $row .= str_pad((string) $v, $value, ' ') . ' | ';
        }
        $this->_n($row);
        $this->_n(str_repeat('-', $width));

    }
}
