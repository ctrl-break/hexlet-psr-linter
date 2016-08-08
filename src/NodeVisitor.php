<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class NodeVisitor extends NodeVisitorAbstract
{
    private $errors = [];

    public function beforeTraverse(array $nodes)
    {
        $result = checkSideEffect($nodes);
        if ($result) {
            $this->errors = $result;
        }
    }

    public function leaveNode(Node $node)
    {
        if (($node instanceof Node\Stmt\Function_) ||
            ($node instanceof Node\Stmt\ClassMethod)) {
            $result = checkFuncName($node);
            if ($result) {
                $this->errors = array_merge($this->errors, $result);
            }
        }

        if ($node instanceof Node\Expr\Variable) {
            $result = checkVarName($node);
            if ($result) {
                $this->errors = array_merge($this->errors, $result);
            }
        }
    }

    public function afterTraverse(array $nodes)
    {
        if (empty($this->errors)) {
            return false;
        }

        return $this->errors;
    }
}
