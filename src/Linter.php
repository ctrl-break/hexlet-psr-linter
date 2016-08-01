<?php

namespace HexletPsrLinter;

class Linter
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function linter()
    {
        if ($this->code) {
            return true;
        }

        return false;
    }
}
