<?php

namespace HexletPsrLinter;

class RulesTest extends \PHPUnit_Framework_TestCase
{
    public function testRules()
    {
        $this->assertTrue(isCamelCase('camelCase'));
        $this->assertTrue(isCamelCase('varname'));
        $this->assertFalse(isCamelCase('var_name'));
        $this->assertFalse(isCamelCase('var_Name'));
        $this->assertFalse(isCamelCase('StudlyCaps'));
        $this->assertFalse(isCamelCase('_varname'));
        $this->assertFalse(isCamelCase('varname_'));
    }
}
