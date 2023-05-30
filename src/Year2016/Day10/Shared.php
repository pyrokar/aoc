<?php

declare(strict_types=1);

namespace AOC\Year2016\Day10;

use Generator;
use SplMaxHeap;

use function Safe\preg_match;

trait Shared
{
    /**
     * @var array<int, int>
     */
    protected array $outputs;

    /**
     * @var SplMaxHeap<int>
     */
    protected SplMaxHeap $botsWithTwoValues;

    /**
     * @var array<int, array<string, int>>
     */
    protected array $instructions;
    /**
     * @var array<int, int[]>
     */
    protected array $bots;

    protected function init(): void
    {
        $this->bots = [];
        $this->botsWithTwoValues = new SplMaxHeap();
        $this->instructions = [];
        $this->outputs = [];
    }

    protected function addValueToBot(int $value, int $bot): void
    {
        if (!isset($this->bots[$bot])) {
            $this->bots[$bot] = [];
        } else {
            $this->botsWithTwoValues->insert($bot);
        }
        $this->bots[$bot][] = $value;
    }

    protected function executeInstructions(): int
    {
        while (!$this->botsWithTwoValues->isEmpty()) {
            $bot = $this->botsWithTwoValues->extract();

            [$low, $high] = array_sort($this->bots[$bot]);

            if (isset($this->instructions[$bot]['lowToBot'])) {
                $this->addValueToBot($low, $this->instructions[$bot]['lowToBot']);
            } elseif (isset($this->instructions[$bot]['lowToOutput'])) {
                $this->outputs[$this->instructions[$bot]['lowToOutput']] = $low;
            }

            if (isset($this->instructions[$bot]['highToBot'])) {
                $this->addValueToBot($high, $this->instructions[$bot]['highToBot']);
            } elseif (isset($this->instructions[$bot]['highToOutput'])) {
                $this->outputs[$this->instructions[$bot]['highToOutput']] = $high;
            }

            //$this->bots[$bot] = [];
        }

        return -1;
    }

    /**
     * @param Generator<void, string, void, void> $input
     */
    protected function processInput(Generator $input): void
    {
        foreach ($input as $line) {
            if (preg_match('/value (?<value>\d+) goes to bot (?<bot>\d+)/', $line, $m)) {
                $bot = (int)$m['bot'];
                $value = (int)$m['value'];

                $this->addValueToBot($value, $bot);

                continue;
            }

            if (preg_match('/bot (?<bot>\d+) gives low to (bot|output) (?<low>\d+) and high to (bot|output) (?<high>\d+)/', $line, $m)) {
                $bot = (int)$m['bot'];
                $lowTo = (int)$m['low'];
                $highTo = (int)$m['high'];

                $instruction = [];
                if ($m[2] === 'bot') {
                    $instruction['lowToBot'] = $lowTo;
                } else {
                    $instruction['lowToOutput'] = $lowTo;
                }
                if ($m[4] === 'bot') {
                    $instruction['highToBot'] = $highTo;
                } else {
                    $instruction['highToOutput'] = $highTo;
                }

                $this->instructions[$bot] = $instruction;
            }
        }
    }
}
