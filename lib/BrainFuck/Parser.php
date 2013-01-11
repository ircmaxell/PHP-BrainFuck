<?php

namespace BrainFuck;

use BrainFuck\Op\Change;
use BrainFuck\Op\Output;
use BrainFuck\Op\Input;
use BrainFuck\Op\Move;
use BrainFuck\Op\Loop;
use LogicException;

class Parser
{
    protected $stdOps = array();

    public function __construct()
    {
        // Use a flyweight here
        $this->stdOps = array(
            '+' => new Change(1),
            '-' => new Change(-1),
            '.' => new Output,
            ',' => new Input,
            '>' => new Move(1),
            '<' => new Move(-1),
        );
    }

    public function parse($program)
    {
        $ops = $this->parseProgram($program);

        return new Loop($ops);
    }

    protected function filterNoOps(array $ops)
    {
        return array_filter($ops, function($op) {
            return (bool) $op;
        });
    }

    protected function parseProgram($program)
    {
        $ops = array();
        $programPos = 0;
        while (isset($program[$programPos])) {
            $ops[] = $this->getOp($program, $programPos);
            $programPos++;
        }

        return $this->filterNoOps($ops);
    }

    protected function getOp($program, &$pos)
    {
        if (isset($this->stdOps[$program[$pos]])) {
            return $this->stdOps[$program[$pos]];
        } elseif ($program[$pos] == ']') {
            throw new \LogicException('Unmatch Brace at pos ' . $pos);
        } elseif ($program[$pos] == '[') {
            return $this->parseLoop($program, $pos);
        }

        return null;
    }

    protected function parseLoop($program, &$pos)
    {
        /**
         * This regex will parse out and match [] braces.
         *
         * Basically, it's a recursive regex, that looks for either
         * non-[] content, or recurses on itself (if it sees a [ character)
         *
         * Errors would only happen if there is no matching ], in which case
         * either no match will occur, or the match will not be for that loop.
         */
        $regex = '((\[((?:[^\[\]]+|(?1))*)\]))';
        $matches = array();
        preg_match($regex, $program, $matches, PREG_OFFSET_CAPTURE, $pos);
        if (!$matches || $matches[0][1] !== $pos) {
            throw new LogicException('Unmatched Brace at pos ' . $pos);
        }
        $pos += strlen($matches[0][0]) - 1;

        return $this->parse($matches[2][0]);
    }

}
