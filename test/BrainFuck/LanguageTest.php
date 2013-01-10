<?php

namespace BrainFuck;

class LanguageTest extends \PHPUnit_Framework_TestCase
{
    public static function provideTestProgram()
    {
        return array(
            array(',+.', array(0), array(1)),
            array(',+.', array(1), array(2)),
            array(',-.', array(1), array(0)),
            array(',>++<.', array(1), array(1)),
            array(',>,>+.<.<.', array(3, 2), array(1, 2, 3)),
            array('[+].', array(), array(0)),
            array(
                '++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.------.--------.>+.>.',
                array(),
                // This is ascii code for "Hello World!\n"
                array(72, 101, 108, 108, 111, 32, 87, 111, 114, 108, 100, 33, 10),
            ),
            array(',/*this should be ignored as a comment*/+.', array(0), array(1)),
            array(
                '-,+[                         Read first character and start outer character reading loop
                    -[                       Skip forward if character is 0
                        >>++++[>++++++++<-]  Set up divisor (32) for division loop
                                               (MEMORY LAYOUT: dividend copy remainder divisor quotient zero zero)
                        <+<-[                Set up dividend (x minus 1) and enter division loop
                            >+>+>-[>>>]      Increase copy and remainder / reduce divisor / Normal case: skip forward
                            <[[>+<-]>>+>]    Special case: move remainder back to divisor and increase quotient
                            <<<<<-           Decrement dividend
                        ]                    End division loop
                    ]>>>[-]+                 End skip loop; zero former divisor and reuse space for a flag
                 >--[-[<->+++[-]]]<[         Zero that flag unless quotient was 2 or 3; zero quotient; check flag
                        ++++++++++++<[       If flag then set up divisor (13) for second division loop
                                               (MEMORY LAYOUT: zero copy dividend divisor remainder quotient zero zero)
                            >-[>+>>]         Reduce divisor; Normal case: increase remainder
                            >[+[<+>-]>+>>]   Special case: increase remainder / move it back to divisor / increase quotient
                            <<<<<-           Decrease dividend
                        ]                    End division loop
                        >>[<+>-]             Add remainder back to divisor to get a useful 13
                        >[                   Skip forward if quotient was 0
                            -[               Decrement quotient and skip forward if quotient was 1
                                -<<[-]>>     Zero quotient and divisor if quotient was 2
                            ]<<[<<->>-]>>    Zero divisor and subtract 13 from copy if quotient was 1
                        ]<<[<<+>>-]          Zero divisor and add 13 to copy if quotient was 0
                    ]                        End outer skip loop (jump to here if ((character minus 1)/32) was not 2 or 3)
                    <[-]                     Clear remainder from first division if second division was skipped
                    <.[-]                    Output ROT13ed character from copy and clear it
                    <-,+                     Read next character
                ]                            End character reading loop',
                array(65, 66, -1),
                array(78, 79),
            ),
        );
    }

    public function testInstantiation()
    {
        $language = new Language();
    }

    /**
     * @dataProvider provideTestProgram
     */
    public function testProgram($program, $input, $expectedOutput)
    {
        $language = new Language;
        $actual = $language->run($program, $input);
        $this->assertEquals($expectedOutput, $actual);
    }

    /**
     * @expectedException LogicException
     */
    public function testParseError()
    {
        $language = new Language;
        $language->run('[', array());
    }

    /**
     * @expectedException LogicException
     */
    public function testParseError2()
    {
        $language = new Language;
        $language->run(']', array());
    }

}
