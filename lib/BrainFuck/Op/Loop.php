<?php

namespace BrainFuck\Op;

class Loop implements \BrainFuck\Op {

    protected $ops = array();

    public function __construct(array $ops) {
        $this->ops = $ops;
    }

    /**
     * @param Memory $memory The active memory for the program
     * @param Input  $input  The current input for the program
     *
     * @return array The output of the op (if any)
     */
    public function execute(\BrainFuck\Memory $memory, \BrainFuck\IO $io) {
        while ($memory->read()) {
            $this->executeProgram($memory, $io);
        }
    }

    public function executeProgram(\BrainFuck\Memory $memory, \BrainFuck\IO $io) {
        foreach ($this->ops as $op) {
            $op->execute($memory, $io);
        }
    }

}
