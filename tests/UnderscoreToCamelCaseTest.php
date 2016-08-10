<?php

namespace HexletPsrLinter;

class UnderscoreToCamelCaseTest extends \PHPUnit_Framework_TestCase
{
    public function testUnderscoreToCamelCase()
    {
        $this->assertEquals(underscoreToCamelCase("my_var_name"), "myVarName");
        $this->assertEquals(underscoreToCamelCase("myvarname"), "myvarname");
        $this->assertEquals(underscoreToCamelCase("Myvarname"), "myvarname");
        $this->assertEquals(underscoreToCamelCase("myvarnamE"), "myvarnamE");
        $this->assertEquals(underscoreToCamelCase("myvar_"), "myvar");
        $this->assertEquals(underscoreToCamelCase("__myvar"), "myvar");
        $this->assertEquals(underscoreToCamelCase("stupid_1_var_2_name"), "stupid1Var2Name");
    }
}
