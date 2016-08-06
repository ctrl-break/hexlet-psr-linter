<?php

namespace HexletPsrLinter;

class CheckFileTest extends \PHPUnit_Framework_TestCase
{
    private $test1;
    private $test2;
    private $test3;

    public function setUp()
    {
        $this->test1 = 'tests/fixtures/file-ok.php';
        $this->test2 = 'tests/fixtures/file-err.php';
        $this->test3 = 'tests/fixtures/file-err.ph';
    }

    public function testCheckFile()
    {
        $this->assertFalse(checkFileErrors($this->test1));

        $result = checkFileErrors($this->test2);
        $this->assertEquals("File or directory doesn't exist", $result['descr']);

        $result = checkFileErrors($this->test3);
        $this->assertEquals('File must have php extension', $result['descr']);
    }
}
