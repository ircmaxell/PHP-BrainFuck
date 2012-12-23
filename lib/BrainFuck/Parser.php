<?php

namespace BrainFuck;

class Parser {

    public function parse($program) {
        $ops = $this->parseProgram(str_split($program));

        return new Op\Loop($ops);
    }

    protected function parseProgram(array $program) {
        // Use a flyweight here
        $stdOps = array(
            '+'  => new Op\Plus,
            '-'  => new Op\Minus,
            '.'  => new Op\Output,
            ','  => new Op\Input,
            '>'  => new Op\MoveRight,
            '<'  => new Op\MoveLeft,
        );
        $ops = array();
        $programPos = 0;
        while (isset($program[$programPos])) {
            $op = $program[$programPos];
            if (isset($stdOps[$op])) {
                $ops[] = $stdOps[$op];
            } elseif ($op == '[') {
                $buffer = $this->parseLoop($program, $programPos);
                $ops[] = new Op\Loop($this->parseProgram($buffer));
            }
            $programPos++;
        }
        return $ops;
    }

    protected function parseLoop(array $program, &$startPos) {
        $openCount = 1;
        $pos = $startPos;
        while (isset($program[++$pos])) {
            switch ($program[$pos]) {
                case '[':
                    $openCount++;
                    break;
                case ']':
                    $openCount--;
                    if ($openCount == 0) {
                        $buffer = array_slice(
                                $program, $startPos + 1, $pos - $startPos - 1
                        );
                        $startPos = $pos;
                        return $buffer;
                    }
                    break;
            }
        }
        throw new \LogicException('Unmatched Braces');
    }
}