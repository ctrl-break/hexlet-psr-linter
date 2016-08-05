<?php

namespace HexletPsrLinter;

class FuncNameTest extends \PHPUnit_Framework_TestCase
{
    public function testFuncName()
    {
        $this->assertTrue(isCamelCase('rightFunc'));
        $this->assertFalse(isCamelCase('WrongFunc'));
        $this->assertTrue(haveUnderscore('some_Func'));
        $this->assertFalse(haveUnderscore('someFunc'));
    }

}
