<?php

declare(strict_types=1);

namespace AOC\Year2019\Day13;

use AOC\Util\Position2D;
use AOC\Year2019\IntCodeComputer;

use function array_chunk;

final class PartTwo
{
    private int $score = 0;

    /**
     * @var array<string, int>
     */
    private array $blocks = [];

    private int $ballX;

    private int $paddleX;

    /**
     * @param string $input
     *
     * @return int
     */
    public function __invoke(string $input): int
    {
        $arcadeCabinet = IntCodeComputer::fromString($input);

        $arcadeCabinet->setMemoryAt(0, 2);
        $arcadeCabinet->execute();

        foreach ($this->getPixel($arcadeCabinet) as $tile) {
            if ($tile[0] === -1 && $tile[1] === 0) {
                $this->score = $tile[2];
            } else {
                if ($tile[2] === 2) {
                    $this->blocks[Position2D::key($tile[0], $tile[1])] = 1;
                }

                if ($tile[2] === 4) {
                    $this->ballX = $tile[0];
                }

                if ($tile[2] === 3) {
                    $this->paddleX = $tile[0];
                }
            }
        }

        $rounds = 100000;

        while (--$rounds > 0) {
            $arcadeCabinet->setInput([$this->getNextInput()]);
            $arcadeCabinet->execute();

            foreach ($this->getPixel($arcadeCabinet) as $tile) {
                if ($tile[0] === -1 && $tile[1] === 0) {
                    $this->score = $tile[2];
                    continue;
                }

                $key = Position2D::key($tile[0], $tile[1]);

                if ($tile[2] === 0 && isset($this->blocks[$key])) {
                    unset($this->blocks[$key]);
                }

                if ($tile[2] === 3) {
                    $this->paddleX = $tile[0];
                }

                if ($tile[2] === 4) {
                    $this->ballX = $tile[0];
                }
            }

            if (count($this->blocks) === 0) {
                break;
            }
        }

        return $this->score;
    }

    /**
     * @param IntCodeComputer $computer
     *
     * @return array<array<int>>
     */
    private function getPixel(IntCodeComputer $computer): array
    {
        return array_chunk($computer->consumeOutput(), 3);
    }

    private function getNextInput(): int
    {
        return $this->ballX <=> $this->paddleX;
    }
}
