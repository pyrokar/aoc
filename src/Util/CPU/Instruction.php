<?php

declare(strict_types=1);

namespace AOC\Util\CPU;

class Instruction
{
    /**
     * @param string $opCode
     * @param array<mixed> $args
     */
    public function __construct(
        public string $opCode,
        public array $args,
    ) {}

    public static function fromString(string $instruction): self
    {
        $arguments = explode(' ', $instruction);
        $opcode = array_shift($arguments);

        return new self($opcode, $arguments);
    }
}
