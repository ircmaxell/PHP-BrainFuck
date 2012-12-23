<?php

namespace BrainFuck;

class Memory {
    protected $memory = array(0);
    protected $pos = 0;
    public function read() {
        return $this->memory[$this->pos];
    }
    public function write($value) {
        $this->memory[$this->pos] = $value;
    }
    public function move($amount) {
        $this->pos += $amount;
        if (!isset($this->memory[$this->pos])) {
            $this->memory[$this->pos] = 0;
        }
    }
}