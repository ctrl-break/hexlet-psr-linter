<?php

namespace HexletPsrLinter;

class LinterTest extends \PHPUnit_Framework_TestCase
{
    public function testFuncName()
    {
        $test1 = new Linter('
            <?php
                function rightFunc(){
                }
            ?>');
        $result = $test1->linter();
        $this->assertEquals(0, count($result));

        $test2 = new Linter('
            <?php
                function WrongFunc(){
                }
            ?>');
        $result = $test2->linter();
        $this->assertEquals(1, count($result));

        $test3 = new Linter('
            <?php
                function Wrong_func2(){
                }
            ?>');
        $result = $test3->linter();
        $this->assertEquals(2, count($result));
    }
}
