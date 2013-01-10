<?php

namespace BrainFuck\Op;

use BrainFuck\Op as Template;
use BrainFuck\Memory;
use BrainFuck\IO;

class Loop implements Template
{
    protected $ops = array();

    public function __construct(array $ops)
    {
        $this->ops = $ops;
    }

    /**
     * @param Memory $memory The active memory for the program
     * @param Input  $input  The current input for the program
     *
     * @return array The output of the op (if any)
     */
    public function execute(Memory $memory, IO $io)
    {
        while ($memory->read()) {
            $this->executeProgram($memory, $io);
        }
    }

    public function executeProgram(Memory $memory, IO $io)
    {
        foreach ($this->ops as $op) {
            $op->execute($memory, $io);
        }
    }
}
