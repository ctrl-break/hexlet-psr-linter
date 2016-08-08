<?php

namespace HexletPsrLinter;

class LinterTest extends \PHPUnit_Framework_TestCase
{
    private $test1;
    private $test2;

    public function setUp()
    {
        $this->test1 = file_get_contents('tests/fixtures/linter-ok.php');
        $this->test2 = file_get_contents('tests/fixtures/linter-err.php');
    }

    public function testLinter()
    {
        $result = linter($this->test1);
        $this->assertFalse($result);

        $result = linter($this->test2);
        $this->assertNotEquals($result, []);
    }
}
