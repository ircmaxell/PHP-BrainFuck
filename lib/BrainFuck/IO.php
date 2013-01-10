<?php

namespace BrainFuck;

class IO
{
    protected $input = array();
    protected $inputPos = 0;
    protected $output = array();

    public function  __construct(array $input)
    {
        $this->input = $input;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function read()
    {
        return isset($this->input[$this->inputPos]) ? $this->input[$this->inputPos++] : 0;
    }

    public function write($value)
    {
        $this->output[] = $value;
    }
}
