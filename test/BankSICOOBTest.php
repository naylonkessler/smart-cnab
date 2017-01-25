<?php

class BankSICOOBTest extends PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $handles = \SmartCNAB\Support\Bank::isHandled(756);

        $this->assertTrue($handles);
    }

    public function testNaming()
    {
        $name = \SmartCNAB\Support\Bank::nameOfNumber(756);

        $this->assertEquals('SICOOB', $name);
    }

    public function testFactoring()
    {
        $bank = \SmartCNAB\Support\Bank::ofNumber(756);

        $this->assertInstanceOf(
            \SmartCNAB\Support\Bank\SICOOB::class,
            $bank
        );
    }
}