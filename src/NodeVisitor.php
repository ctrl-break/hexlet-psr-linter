<?php

namespace HexletPsrLinter;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\PrettyPrinter;

class NodeVisitor extends NodeVisitorAbstract
{
    private $errors = [];
    private $fix = false;

    public function __construct($fix)
    {
        $this->fix = $fix;
    }

    public function beforeTraverse(array $nodes)
    {
        $result = checkSideEffect($nodes);
        if ($result) {
            $this->errors[] = $result;
        }
    }

    public function leaveNode(Node $node)
    {
        if (($node instanceof Node\Stmt\Function_) ||
            ($node instanceof Node\Stmt\ClassMethod)) {
            $result = checkFuncName($node);
            if ($result) {
                if ($this->fix) {
                    $node->name = fixFuncName($node->name);
                    $result['errorType'] = 'fixed';
                    $result['name'] = $result['name'].' -> '.$node->name;
                }
                $this->errors[] = $result;
            }
        }

        if ($node instanceof Node\Expr\Variable) {
            $result = checkVarName($node);
            if ($result) {
                if ($this->fix) {
                    $node->name = fixVarName($node->name);
                    $result['errorType'] = 'fixed';
                    $result['name'] = $result['name'].' -> '.$node->name;
                }
                $this->errors[] = $result;
            }
        }
    }

    public function afterTraverse(array $nodes)
    {
        $prettyPrinter = new PrettyPrinter\Standard();
        $code = $prettyPrinter->prettyPrintFile($nodes);
        if (empty($this->errors)) {
            return [false, $code];
        }

        return [$this->errors, $code];
    }
}
