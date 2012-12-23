<?php

namespace BrainFuck;

class Input {
    protected $data = array();
    protected $dataPos = 0;

    public function  __construct(array $input) {
        $this->data = $input;
    }

    public function read() {
        return isset($this->data[$this->dataPos]) ? $this->data[$this->dataPos++] : 0;
    }
}
