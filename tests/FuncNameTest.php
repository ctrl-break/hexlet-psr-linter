<?php

namespace HexletPsrLinter;

class FuncNameTest extends \PHPUnit_Framework_TestCase
{
    public function testFuncName()
    {
        $this->assertTrue(validateFuncName('rightFunc'));
        $this->assertTrue(validateFuncName('__construct'));
        $this->assertFalse(validateFuncName('WrongFunc'));
        $this->assertFalse(validateFuncName('wrong_Func'));
        $this->assertFalse(validateFuncName('_someFunc'));
    }
}
