<?php

namespace HexletPsrLinter;

use PhpParser\ParserFactory;

class SideEffectTest extends \PHPUnit_Framework_TestCase
{
    private $test1;
    private $test2;
    private $test3;

    public function setUp()
    {
        $parser1 = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $this->test1 = $parser1->parse(file_get_contents(
            'tests/fixtures/sideeffects/sideeffect.php'));

        $parser2 = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $this->test2 = $parser2->parse(file_get_contents(
            'tests/fixtures/sideeffects/declaration.php'));

        $parser3 = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        $this->test3 = $parser3->parse(file_get_contents(
            'tests/fixtures/sideeffects/se_plus_declaration.php'));
    }

    public function testCheckSideEffect()
    {
        $this->assertFalse(hasSideEffectAndDeclaration($this->test1));
        $this->assertFalse(hasSideEffectAndDeclaration($this->test2));
        $this->assertTrue(hasSideEffectAndDeclaration($this->test3));
    }
}
