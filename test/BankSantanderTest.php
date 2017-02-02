<?php

class BankSantanderTest extends PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $handles = \SmartCNAB\Support\Bank::isHandled(33);

        $this->assertTrue($handles);
    }

    public function testNaming()
    {
        $name = \SmartCNAB\Support\Bank::nameOfNumber(33);

        $this->assertEquals('Santander', $name);
    }

    public function testFactoring()
    {
        $bank = \SmartCNAB\Support\Bank::ofNumber(33);

        $this->assertInstanceOf(
            \SmartCNAB\Support\Bank\Santander::class,
            $bank
        );
    }
}