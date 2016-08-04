<?php

namespace HexletPsrLinter;

class LinterFunctionTest extends \PHPUnit_Framework_TestCase
{
    private $test1;
    private $test2;
    private $test3;
    private $test4;

    public function setUp()
    {
        $this->test1 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test1.php';
        $this->test2 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test2.php';
        $this->test3 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test3.php';
        $this->test4 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test4.php';
    }

    public function testFuncName()
    {
        $test1 = new Linter(file_get_contents($this->test1));
        $result = $test1->linter();
        $this->assertEquals(0, count($result));

        $test2 = new Linter(file_get_contents($this->test2));
        $result = $test2->linter();
        $this->assertEquals(1, count($result));

        $test3 = new Linter(file_get_contents($this->test3));
        $result = $test3->linter();
        $this->assertEquals(2, count($result));

        $test4 = new Linter(file_get_contents($this->test4));
        $result = $test4->linter();
        $this->assertEquals(2, count($result));
    }
}
