<?php

namespace HexletPsrLinter;

use PhpParser\Error;
use PhpParser\NodeTraverser;
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
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $traverser = new NodeTraverser();
        $traverser->addVisitor(new NodeVisitor());

        try {
            $stmts = $parser->parse($this->code);
            return $traverser->traverse($stmts);
        } catch (Error $e) {
          //eval(\Psy\sh());
            return [
                        ['descr' => $e->getMessage()." \nLinter was stopped.",
                        'funcName' => '-',
                        'startLine' => '0',
                        'errorType' => 'error', ],
                       ];
        }
    }
}
