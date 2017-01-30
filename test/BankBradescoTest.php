<?php

class BankBradescoTest extends PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $handles = \SmartCNAB\Support\Bank::isHandled(237);

        $this->assertTrue($handles);
    }

    public function testNaming()
    {
        $name = \SmartCNAB\Support\Bank::nameOfNumber(237);

        $this->assertEquals('Bradesco', $name);
    }

    public function testFactoring()
    {
        $bank = \SmartCNAB\Support\Bank::ofNumber(237);

        $this->assertInstanceOf(\SmartCNAB\Support\Bank\Bradesco::class, $bank);
    }
}