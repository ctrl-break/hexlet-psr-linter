<?php

namespace HexletPsrLinter;

class VarNameTest extends \PHPUnit_Framework_TestCase
{
    public function testVarName()
    {
        $this->assertTrue(validateVarName('varName'));
        $this->assertTrue(validateVarName('varNameVeryVeryLongName'));
        $this->assertTrue(validateVarName('varname'));
        $this->assertFalse(validateVarName('var_name'));
        $this->assertFalse(validateVarName('VarName'));
    }
}
