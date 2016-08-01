<?php

namespace HexletPsrLinter;

class LinterTest extends \PHPUnit_Framework_TestCase
{
    public function testLinter()
    {
        /*
        $test0 = new Linter('');
        $this->assertFalse($test0->linter());

        $test1 = new Linter('<?php function rightFunc() { echo "ok" }; ?>');
        $this->assertTrue($test1->linter());*/

        $test2 = new Linter('
            <?php
                function wrong_func(){
                    echo "-";
                }
            ?>');
        $this->assertFalse($test2->linter());
    }
}
