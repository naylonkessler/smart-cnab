<?php

class BankCaixaTest extends PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $handles = \SmartCNAB\Support\Bank::isHandled(104);

        $this->assertTrue($handles);
    }

    public function testNaming()
    {
        $name = \SmartCNAB\Support\Bank::nameOfNumber(104);

        $this->assertEquals('Caixa', $name);
    }

    public function testFactoring()
    {
        $bank = \SmartCNAB\Support\Bank::ofNumber(104);

        $this->assertInstanceOf(\SmartCNAB\Support\Bank\Caixa::class, $bank);
    }
}