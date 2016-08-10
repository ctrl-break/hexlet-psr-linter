<?php

namespace HexletPsrLinter;

class WriteFixedFileTest extends \PHPUnit_Framework_TestCase
{
    private $test1;
    private $test2;
    private $standard;

    public function setUp()
    {
        $this->test1 = 'tests/fixtures/writeTest/write-err.php';
        $this->test2 = 'tests/fixtures/writeTest/write-ok.php';
        $this->standard = 'tests/fixtures/writeTest/standard.php';
    }

    public function testWriteFixedFile()
    {
        $code1 = file_get_contents($this->test1);
        list($lint, $fixedCode) = linter($code1, true);

        writeFixedCode($this->test2, $fixedCode);

        $code2 = file_get_contents($this->test2);
        $standard = file_get_contents($this->standard);
        $this->assertEquals($code2, $standard);
    }
}
