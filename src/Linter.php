<?php

namespace HexletPsrLinter;

//use PhpParser\Error;
use PhpParser\ParserFactory;

class Linter
{
    private $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function linter()
    {
				$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);

				try {
				    $stmts = $parser->parse($this->code);
						var_dump($stmts);
						//return $stmts;
				} catch (Error $e) {
				    echo 'Parse Error: ', $e->getMessage();
				}
    }
}
