<?php

namespace BrainFuck\Op;

use BrainFuck\Op as Template;
use BrainFuck\Memory;
use BrainFuck\IO;

class Change implements Template
{
    protected $amount = 0;

    public function __construct($amount = 0)
    {
        $this->amount = $amount;
    }

    /**
     * @param Memory $memory The active memory for the program
     * @param Input  $input  The current input for the program
     *
     * @return array The output of the op (if any)
     */
    public function execute(Memory $memory, IO $io)
    {
        $memory->write($memory->read() + $this->amount);
    }
}
