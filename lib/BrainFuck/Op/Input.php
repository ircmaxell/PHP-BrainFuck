<?php

namespace BrainFuck\Op;

class Input implements \BrainFuck\Op {

    /**
     * @param Memory $memory The active memory for the program
     * @param Input  $input  The current input for the program
     *
     * @return array The output of the op (if any)
     */
    public function execute(\BrainFuck\Memory $memory, \BrainFuck\IO $io) {
        $memory->write($io->read());
    }

}
