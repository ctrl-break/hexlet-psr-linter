<?php

namespace HexletPsrLinter;

class MakeReportTest extends \PHPUnit_Framework_TestCase
{
    private $file;
    private $text;
    private $json;
    private $yaml;

    public function setUp()
    {
        $this->file = './tests/fixtures/report/test.php';
        $this->text = file_get_contents('tests/fixtures/report/report.txt');
        $this->json = file_get_contents('tests/fixtures/report/report.json');
        $this->yaml = file_get_contents('tests/fixtures/report/report.yml');
    }

    public function testMakeReport()
    {
        $result = [];
        list($linterErrors, $code) = linter(file_get_contents($this->file), false);
        $result[$this->file] = $linterErrors;

        $text = makeReport($result, 'text');
        $this->assertEquals($text, $this->text);

        $json = makeReport($result, 'json');
        $this->assertEquals($json, $this->json);

        $yaml = makeReport($result, 'yaml');
        $this->assertEquals($yaml, $this->yaml);
    }
}
