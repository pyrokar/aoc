<?php

declare(strict_types=1);

namespace AOC\Util\CPU\Event;

use AOC\Util\CPU\CPU;
use AOC\Util\CPU\Instruction;
use AOC\Util\Event\Event;
use Override;

final class BeforeExecuteInstruction implements Event
{
    public const string NAME = 'beforeExecuteInstruction';

    public function __construct(
        public readonly CPU $cpu,
        public readonly Instruction $instruction,
    ) {}

    #[Override]
    public function getName(): string
    {
        return self::NAME;
    }
}
