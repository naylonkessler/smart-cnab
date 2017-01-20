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
}