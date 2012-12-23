<?php

namespace BrainFuck;

class Parser {

    protected $noOp;
    protected $stdOps = array();

    public function __construct() {
        // Use a flyweight here
        $this->stdOps = array(
            '+' => new Op\Plus,
            '-' => new Op\Minus,
            '.' => new Op\Output,
            ',' => new Op\Input,
            '>' => new Op\MoveRight,
            '<' => new Op\MoveLeft,
        );
        $this->noOp = new Op\NoOp;
    }

    public function parse($program) {
        $ops = $this->parseProgram(str_split($program));

        return new Op\Loop($this->filterNoOps($ops));
    }

    protected function filterNoOps(array $ops) {
        return array_filter($ops, function($op) { return !$op instanceof Op\NoOp; });
    }

    protected function parseProgram(array $program) {
        $ops = array();
        $programPos = 0;
        while (isset($program[$programPos])) {
            $ops[] = $this->getOp($program, $programPos);
            $programPos++;
        }
        return $ops;
    }

    protected function getOp(array $program, &$pos) {
        if (isset($this->stdOps[$program[$pos]])) {
            return $this->stdOps[$program[$pos]];
        } elseif ($program[$pos] == ']') {
            throw new \LogicException('Unmatch Brace at pos ' . $pos);
        } elseif ($program[$pos] == '[') {
            return $this->parseLoop($program, $pos);
        } else {
            return $this->noOp;
        }
    }

    protected function parseLoop(array $program, &$pos) {
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
        $rawProgram = implode('', $program);
        $matches = array();
        preg_match($regex, $rawProgram, $matches, PREG_OFFSET_CAPTURE, $pos);
        if (!$matches || $matches[0][1] !== $pos) {
            throw new \LogicException('Unmatched Brace at pos ' . $pos);
        }
        $pos += strlen($matches[0][0]) - 1;
        return $this->parse($matches[2][0]);
    }

}