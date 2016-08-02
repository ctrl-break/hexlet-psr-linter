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
            $err[] = ['Имя функции должно начинаться с буквы в нижнем регистре',
                      $value->name,
                      $value->getAttributes(),
                     ];
        }

        if (strpos($value->name, '_') !== false) {
            $err[] = ['В имени функции не должно быть знаков подчеркивания',
                      $value->name,
                      $value->getAttributes(),
                     ];
        }

        if (!\PHP_CodeSniffer::isCamelCaps($value->name)) {
            $err[] = ['Имя функции должно быть написано в стиле camelCase',
                      $value->name,
                      $value->getAttributes(),
                     ];
        }

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
