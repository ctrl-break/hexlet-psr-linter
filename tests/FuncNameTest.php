<?php

namespace HexletPsrLinter;

class FuncNameTest extends \PHPUnit_Framework_TestCase
{
    private $test1;
    private $test2;
    private $test3;
    private $test4;

    public function setUp()
    {
        $this->test1 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test1';
        $this->test2 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test2';
        $this->test3 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test3';
        $this->test4 = __DIR__.DIRECTORY_SEPARATOR.'fixtures'
                       .DIRECTORY_SEPARATOR.'function'
                       .DIRECTORY_SEPARATOR.'test4';
    }

    public function testFuncName()
    {
        $test = new Linter();

        $test->setCode(file_get_contents($this->test1));
        $result = $test->linter();
        $this->assertEquals(0, count($result));

        $test->setCode(file_get_contents($this->test2));
        $result = $test->linter();
        $this->assertEquals(1, count($result));

        $test->setCode(file_get_contents($this->test3));
        $result = $test->linter();
        $this->assertEquals(2, count($result));

        $test->setCode(file_get_contents($this->test4));
        $result = $test->linter();
        $this->assertEquals(2, count($result));
    }
}
