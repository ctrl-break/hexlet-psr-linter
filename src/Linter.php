<?php

namespace HexletPsrLinter;

class Linter
{
		public $code;

		public function _construct($code)
		{
			$this->code = $code;
		}

    public function linter()
    {
        if ($this->code) return true;
				return false;
    }
}
