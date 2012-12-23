<?php

namespace BrainFuck;

interface Op {

    /**
     * @param Memory $memory The active memory for the program
     * @param IO     $io     The IO stack for the program
     */
    public function execute(\BrainFuck\Memory $memory, \BrainFuck\IO $io);

}