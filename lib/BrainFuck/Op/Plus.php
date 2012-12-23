<?php

namespace BrainFuck\Op;

class Plus implements \BrainFuck\Op {

    /**
     * @param Memory $memory The active memory for the program
     * @param Input  $input  The current input for the program
     *
     * @return array The output of the op (if any)
     */
    public function execute(\BrainFuck\Memory $memory, \BrainFuck\Input $input) {
        $memory->write($memory->read() + 1);
    }

}
