<?php

class BankSupportSantanderTest extends PHPUnit_Framework_TestCase
{
    public function testSantander()
    {
        $santander = new \SmartCNAB\Support\Bank\Santander;

        $this->assertInstanceOf(\SmartCNAB\Support\Bank\Santander::class, $santander);

        return $santander;
    }

    /**
     * @depends testSantander
     */
    public function testChannels($santander)
    {
        $this->assertEquals([], $santander->channels());
    }

    /**
     * @depends testSantander
     */
    public function testMotives($santander)
    {
        $this->assertEquals([], $santander->motives());
    }

    /**
     * @depends testSantander
     */
    public function testRejectionCodes($santander)
    {
        $this->assertInternalType('array', $santander->rejectionCodes());
    }

    /**
     * @depends testSantander
     */
    public function testEmission($santander)
    {
        $this->assertInternalType('array', $santander->emission());
    }

    /**
     * @depends testSantander
     */
    public function testPostage($santander)
    {
        $this->assertInternalType('array', $santander->postage());
    }

    /**
     * @depends testSantander
     */
    public function testBilling($santander)
    {
        $this->assertInternalType('array', $santander->billing());
    }
}