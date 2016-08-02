<?php

namespace HexletPsrLinter;

use PhpParser\Error;
use PhpParser\ParserFactory;

class Linter
{
    private $code;
    private $errors = [];

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function checkFuncName($value)
    {
        $err = [];
        if (!preg_match('/[a-z]/', $value->name[0])) {
            $err[] = ['First letter of function name must be in lowercase',
                      $value->name,
                      $value->getAttributes(),
                      'warning',
                     ];
        }

        if (strpos($value->name, '_') !== false) {
            $err[] = ['Function name should not include the underscore',
                      $value->name,
                      $value->getAttributes(),
                      'warning',
                     ];
        }

        if (!\PHP_CodeSniffer::isCamelCaps($value->name)) {
            $err[] = ['Function name should be written in camelCase style',
                      $value->name,
                      $value->getAttributes(),
                      'warning',
                     ];
        }
  //      var_dump($value);

        return $err;
    }

    public function linter()
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);

        try {
            $stmts = $parser->parse($this->code);
        } catch (Error $e) {
            echo 'Parse Error: ', $e->getMessage();
        }

        foreach ($stmts as $value) {
            if (isset($value->name) && get_class($value) === 'PhpParser\Node\Stmt\Function_') {
                $this->errors = array_merge($this->errors, $this->checkFuncName($value));
            }
        }

        return $this->errors;
    }
}
