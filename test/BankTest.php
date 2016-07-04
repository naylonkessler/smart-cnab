<?php

class BankTest extends PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $handles = \SmartCNAB\Support\Bank::isHandled(341);

        $this->assertTrue($handles);
    }

    public function testNaming()
    {
        $name = \SmartCNAB\Support\Bank::nameOfNumber(341);

        $this->assertEquals('Itau', $name);
    }

    public function testFactoring()
    {
        $bank = \SmartCNAB\Support\Bank::ofNumber(341);

        $this->assertInstanceOf(
            \SmartCNAB\Support\Bank\Itau::class,
            $bank
        );
    }
}