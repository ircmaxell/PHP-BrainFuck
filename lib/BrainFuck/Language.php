<?php

namespace BrainFuck;

class Language {

    public function run($program, array $input = array()) {
        $output = array();
        $memory = array(0);
        $memoryPos = 0;
        $inputPos = 0;

        $program = $this->parse($program);

        foreach ($program as $op) {
            switch ($op) {
                case ',':
                    $memory[$memoryPos] = $input[$inputPos++];
                    break;
                case '.':
                    $output[] = $memory[$memoryPos];
                    break;
                case '+':
                    $memory[$memoryPos]++;
                    break;
                case '-':
                    $memory[$memoryPos]--;
                    break;
                case '>':
                    $memoryPos++;
                    break;
                case '<':
                    $memoryPos--;
                    break;
            }
            if (!isset($memory[$memoryPos])) {
                $memory[$memoryPos] = 0;
            }
        }
        return $output;
    }

    protected function parse($program) {
        return str_split($program);
    }

}