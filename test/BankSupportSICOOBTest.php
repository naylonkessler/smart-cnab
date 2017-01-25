<?php

class BankSupportSICOOBTest extends PHPUnit_Framework_TestCase
{
    public function testSICOOB()
    {
        $sicoob = new \SmartCNAB\Support\Bank\SICOOB;

        $this->assertInstanceOf(\SmartCNAB\Support\Bank\SICOOB::class, $sicoob);

        return $sicoob;
    }

    /**
     * @depends testSICOOB
     */
    public function testChannels($sicoob)
    {
        $this->assertEquals([], $sicoob->channels());
    }

    /**
     * @depends testSICOOB
     */
    public function testMotives($sicoob)
    {
        $this->assertEquals([], $sicoob->motives());
    }

    /**
     * @depends testSICOOB
     */
    public function testRejectionCodes($sicoob)
    {
        $this->assertEquals([], $sicoob->rejectionCodes());
    }
}