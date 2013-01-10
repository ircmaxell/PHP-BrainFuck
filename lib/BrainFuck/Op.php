<?php

namespace BrainFuck;

use BrainFuck\Memory;
use BrainFuck\IO;

interface Op
{
    /**
     * @param Memory $memory The active memory for the program
     * @param IO     $io     The IO stack for the program
     */
    public function execute(Memory $memory, IO $io);
}
