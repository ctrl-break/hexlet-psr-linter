<?php

namespace HexletPsrLinter;

class LinterTest extends \PHPUnit_Framework_TestCase
{
    public function testLinter()
    {
        $test1 = new Linter('
            <?php
                function rightFunc(){
                    echo "ok";
                }
            ?>');
        $this->assertTrue($test1->linter());

        $test2 = new Linter('
            <?php
                function wrong_func(){
                    echo "-";
                }
            ?>');
        $result = $test2->linter();
        $this->assertEquals(false, $result[0]);
    }
}
