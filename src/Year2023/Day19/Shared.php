<?php

declare(strict_types=1);

namespace AOC\Year2023\Day19;

use Safe\Exceptions\PcreException;

use function Safe\preg_match;

/**
 * @phpstan-type Range array{int, int}
 * @phpstan-type Ranges array{x: Range, m: Range, a: Range, s: Range}
 */
trait Shared
{
    /** @var array<string, list<array<mixed>>> */
    protected array $workflows;

    /** @var array<Ranges> */
    protected array $acceptedRanges;

    /**
     * @param string $line
     *
     * @throws PcreException
     */
    public function extractWorkflow(string $line): void
    {
        if (!preg_match('/(?<name>\w+)\{(?<rules>.*)}/', $line, $m)) {
            return;
        }

        $name = $m['name'];
        $r = explode(',', $m['rules']);

        $rules = [];
        foreach ($r as $rule) {
            if (preg_match('/(?<p>\w)(?<op>[<>])(?<v>\d+):(?<wf>\w+)/', $rule, $m)) {
                $rules[] = [$m['p'], $m['op'], (int) $m['v'], $m['wf']];
            } else {
                $rules[] = [$rule];
            }
        }

        $this->workflows[$name] = $rules;
    }

    /**
     * @param non-empty-list<string> $path
     * @param Ranges $ranges
     *
     * @return void
     */
    protected function findAcceptedRanges(array $path = ['in'], array $ranges = ['x' => [1, 4001], 'm' => [1, 4001], 'a' => [1, 4001], 's' => [1, 4001]]): void
    {
        $name = $path[array_key_last($path)];

        if ($name === 'A') {
            $this->acceptedRanges[] = $ranges;
            return;
        }

        foreach ($this->workflows[$name] ?? [] as $rule) {
            if (count($rule) === 4) {
                $newRanges = $ranges;

                if ($rule[1] === '>' && $ranges[$rule[0]][1] > $rule[2]) {
                    $ranges[$rule[0]][1] = $rule[2] + 1;
                } elseif ($rule[1] === '<' && $ranges[$rule[0]][0] < $rule[2]) {
                    $ranges[$rule[0]][0] = $rule[2];
                }

                if ($rule[1] === '<' && $newRanges[$rule[0]][1] > $rule[2]) {
                    $newRanges[$rule[0]][1] = $rule[2];
                } elseif ($rule[1] === '>' && $newRanges[$rule[0]][0] < $rule[2]) {
                    $newRanges[$rule[0]][0] = $rule[2] + 1;
                }

                /** @var Ranges $newRanges */
                $this->findAcceptedRanges([...$path, $rule[3]], $newRanges);

                continue;
            }

            /** @var Ranges $ranges */
            $this->findAcceptedRanges([...$path, $rule[0]], $ranges);
        }
    }
}
