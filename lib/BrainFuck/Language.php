<?php

namespace BrainFuck;

class Language
{
    protected $parser;

    public function __construct(Parser $parser = null)
    {
        if (!$parser) {
            $parser = new Parser;
        }
        $this->parser = $parser;
    }

    public function run($program, array $input = array())
    {
        $memory = new Memory;
        $io = new IO($input);

        $ops = $this->parser->parse($program);

        $ops->executeProgram($memory, $io);

        return $io->getOutput();
    }

}
