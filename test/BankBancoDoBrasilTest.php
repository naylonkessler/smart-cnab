<?php

class BankBancoDoBrasilTest extends PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $handles = \SmartCNAB\Support\Bank::isHandled(001);

        $this->assertTrue($handles);
    }

    public function testNaming()
    {
        $name = \SmartCNAB\Support\Bank::nameOfNumber(001);

        $this->assertEquals('BancoDoBrasil', $name);
    }

    public function testFactoring()
    {
        $bank = \SmartCNAB\Support\Bank::ofNumber(001);

        $this->assertInstanceOf(
            \SmartCNAB\Support\Bank\BancoDoBrasil::class,
            $bank
        );
    }
}