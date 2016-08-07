<?php

namespace HexletPsrLinter;

class VarNameTest extends \PHPUnit_Framework_TestCase
{
    public function testVarName()
    {
        $this->assertTrue(correctVarName('varName'));
        $this->assertTrue(correctVarName('varNameVeryVeryLongName'));
        $this->assertTrue(correctVarName('varname'));
        $this->assertFalse(correctVarName('var_name'));
        $this->assertFalse(correctVarName('VarName'));
    }
}
