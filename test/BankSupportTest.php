<?php

class BankSupportTest extends PHPUnit_Framework_TestCase
{
    public function testItau()
    {
        $itau = new \SmartCNAB\Support\Bank\Itau;

        $this->assertInstanceOf(\SmartCNAB\Support\Bank\Itau::class, $itau);

        return $itau;
    }

    /**
     * @depends testItau
     */
    public function testChannels($itau)
    {
        $this->assertEquals([], $itau->channels());
    }

    /**
     * @depends testItau
     */
    public function testDocumentsPrefixes($itau)
    {
        $this->assertEquals([], $itau->documentsPrefixes());
    }

    /**
     * @depends testItau
     */
    public function testMotives($itau)
    {
        $this->assertEquals([], $itau->motives());
    }

    /**
     * @depends testItau
     */
    public function testRejectionCodes($itau)
    {
        $this->assertEquals([], $itau->rejectionCodes());
    }

    /**
     * @depends testItau
     */
    public function testEmission($itau)
    {
        $this->assertInternalType('array', $itau->emission());
    }

    /**
     * @depends testItau
     */
    public function testPostage($itau)
    {
        $this->assertInternalType('array', $itau->postage());
    }

    /**
     * @depends testItau
     */
    public function testBilling($itau)
    {
        $this->assertInternalType('array', $itau->billing());
    }
}