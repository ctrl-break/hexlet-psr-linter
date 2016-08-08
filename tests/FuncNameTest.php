<?php

namespace HexletPsrLinter;

class FuncNameTest extends \PHPUnit_Framework_TestCase
{
    public function testFuncName()
    {
        $this->assertTrue(isCorrectFuncName('rightFunc'));
        $this->assertTrue(isCorrectFuncName('__construct'));
        $this->assertFalse(isCorrectFuncName('WrongFunc'));
        $this->assertFalse(isCorrectFuncName('wrong_Func'));
        $this->assertFalse(isCorrectFuncName('_someFunc'));
    }
}
