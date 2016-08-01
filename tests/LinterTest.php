<?php

namespace HexletPsrLinter;

require_once "src/Linter.php";

class LinterTest extends \PHPUnit_Framework_TestCase
{
    public function testLinter()
    {
        $test1 = new Linter;
        $this->assertTrue($test1->linter());
    }
}
