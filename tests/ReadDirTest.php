<?php

namespace HexletPsrLinter;

class ReadDirTest extends \PHPUnit_Framework_TestCase
{
    private $test1;

    public function setUp()
    {
        $this->test1 = 'tests/fixtures/testdir';
    }

    public function testReadDir()
    {
        $this->assertEquals(count(readDir($this->test1)), 4);
    }
}
