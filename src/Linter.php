<?php

namespace HexletPsrLinter;

//use PhpParser\Error;
use PhpParser\ParserFactory;

class Linter
{
    private $code;
    private $errors = [];

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function linter()
    {
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);

        try {
            $stmts = $parser->parse($this->code);
            foreach ($stmts as $key => $value) {
                if (isset($value->name) && get_class($value) === 'PhpParser\Node\Stmt\Function_') {
                    if (!preg_match('/^[a-z]*[A-Z0-9]*[a-zA-Z0-9]*/', $value->name[0])) {
                        $this->errors[] = [false,
                                                'Имя функции должно начинатся с буквы в нижнем регистре и быть написано в стиле camelCase',
                                                $value->getAttributes(), ];
                        var_dump($value->name);
                    }
                    if (strpos('_', $value->name) !== false) {
                        $this->errors[] = [false, 'В имени функции не должно быть знаков подчеркивания', $value->getAttributes()];
                    }
                    if (empty($this->errors)) {
                        return true;
                    }

                    return $this->errors;
                }
            }
        } catch (Error $e) {
            echo 'Parse Error: ', $e->getMessage();
        }
    }
}
