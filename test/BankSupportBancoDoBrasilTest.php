<?php

class BankSupportBancoDoBrasilTest extends PHPUnit_Framework_TestCase
{
    public function testBancoDoBrasil()
    {
        $bancoDoBrasil = new \SmartCNAB\Support\Bank\BancoDoBrasil;

        $this->assertInstanceOf(\SmartCNAB\Support\Bank\BancoDoBrasil::class, $bancoDoBrasil);

        return $bancoDoBrasil;
    }

    /**
     * @depends testBancoDoBrasil
     */
    public function testChannels($bancoDoBrasil)
    {
        $this->assertInternalType('array', $bancoDoBrasil->channels());
    }

    /**
     * @depends testBancoDoBrasil
     */
    public function testMotives($bancoDoBrasil)
    {
        $this->assertInternalType('array', $bancoDoBrasil->motives());
    }

    /**
     * @depends testBancoDoBrasil
     */
    public function testRejectionCodes($bancoDoBrasil)
    {
        $this->assertEquals([], $bancoDoBrasil->rejectionCodes());
    }
}