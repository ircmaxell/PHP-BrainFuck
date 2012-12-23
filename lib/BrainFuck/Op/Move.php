<?php

namespace BrainFuck\Op;

class Move implements \BrainFuck\Op {

    protected $direction = 0;

    public function __construct($direction = 0) {
        $this->direction = $direction;
    }

    /**
     * @param Memory $memory The active memory for the program
     * @param Input  $input  The current input for the program
     *
     * @return array The output of the op (if any)
     */
    public function execute(\BrainFuck\Memory $memory, \BrainFuck\IO $io) {
        $memory->move($this->direction);
    }

}
