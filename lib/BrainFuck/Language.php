<?php

namespace BrainFuck;

class Language {

    public function run($program, array $input = array()) {
        $memory = new Memory;
        $input = new Input($input);

        $ops = $this->parse(str_split($program));

        $output = array();
        foreach ($ops as $op) {
            $tmpOut = $op->execute($memory, $input);
            if ($tmpOut) {
                $output = array_merge($output, $tmpOut);
            }
        }
        return $output;
    }

    protected function parse(array $program) {
        $ops = array();
        $programPos = 0;
        while(isset($program[$programPos])) {
            switch ($program[$programPos]) {
                case '+':
                    $ops[] = new Op\Plus;
                    break;
                case '-':
                    $ops[] = new Op\Minus;
                    break;
                case '.':
                    $ops[] = new Op\Output;
                    break;
                case ',':
                    $ops[] = new Op\Input;
                    break;
                case '>':
                    $ops[] = new Op\MoveRight;
                    break;
                case '<':
                    $ops[] = new Op\MoveLeft;
                    break;
                case '[':
                    $buffer = $this->parseLoop($program, $programPos);
                    $ops[] = new Op\Loop($this->parse($buffer));
                    break;
            }
            $programPos++;
        }
        return $ops;
    }

    protected function parseLoop(array $program, &$startPos) {
        $openCount = 1;
        $pos = $startPos;
        while (isset($program[++$pos])) {
            switch($program[$pos]) {
                case '[':
                    $openCount++;
                    break;
                case ']':
                    $openCount--;
                    if ($openCount == 0) {
                        $buffer = array_slice(
                                $program,
                                $startPos + 1,
                                $pos - $startPos - 1
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