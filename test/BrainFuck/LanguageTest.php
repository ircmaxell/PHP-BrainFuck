<?php

namespace BrainFuck;

class LanguageTest extends \PHPUnit_Framework_TestCase {

    public static function provideTestProgram() {
        return array(
            array(',+.', array(0), array(1)),
            array(',+.', array(1), array(2)),
            array(',-.', array(1), array(0)),
            array(',>++<.', array(1), array(1)),
            array(',>,>+.<.<.', array(3, 2), array(1, 2, 3)),
        );
    }

    public function testInstantiation() {
        $language = new Language();
    }

    /**
     * @dataProvider provideTestProgram
     */
    public function testProgram($program, $input, $expectedOutput) {
        $language = new Language;
        $actual = $language->run($program, $input);
        $this->assertEquals($expectedOutput, $actual);
    }

}