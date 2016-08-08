<?php

namespace HexletPsrLinter;

class VarNameTest extends \PHPUnit_Framework_TestCase
{
    public function testVarName()
    {
        $this->assertTrue(isCorrectVarName('varName'));
        $this->assertTrue(isCorrectVarName('varNameVeryVeryLongName'));
        $this->assertTrue(isCorrectVarName('varname'));
        $this->assertFalse(isCorrectVarName('var_name'));
        $this->assertFalse(isCorrectVarName('VarName'));
    }
}
