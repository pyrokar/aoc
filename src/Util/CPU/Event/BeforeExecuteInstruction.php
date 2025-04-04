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
        readonly public CPU $cpu,
        readonly public Instruction $instruction,
    ) {}

    #[Override]
    public function getName(): string
    {
        return self::NAME;
    }
}
