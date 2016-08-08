<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class NodeVisitor extends NodeVisitorAbstract
{
    private $errors = [];

    public function beforeTraverse(array $nodes)
    {
        $this->errors = checkSideEffect($nodes);
    }

    public function leaveNode(Node $node)
    {
        if (($node instanceof Node\Stmt\Function_) ||
            ($node instanceof Node\Stmt\ClassMethod)) {
            $this->errors = array_merge($this->errors, checkFuncName($node));
        }

        if ($node instanceof Node\Expr\Variable) {
            $this->errors = array_merge($this->errors, checkVarName($node));
        }
    }

    public function afterTraverse(array $nodes)
    {
        return $this->errors;
    }
}
