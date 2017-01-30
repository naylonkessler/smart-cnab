<?php

class BankSupportBradescoTest extends PHPUnit_Framework_TestCase
{
    public function testBankSupBradesco()
    {
        $bradesco = new \SmartCNAB\Support\Bank\Bradesco;

        $this->assertInstanceOf(\SmartCNAB\Contracts\Support\BankSupport::class, $bradesco);

        return $bradesco;
    }

    /**
     * @depends testBankSupBradesco
     */
    public function testDocumentsPrefixes($bradesco)
    {
        $this->assertInternalType('array', $bradesco->documentsPrefixes());
        $this->assertEquals([], $bradesco->documentsPrefixes());
    }

    /**
     * @depends testBankSupBradesco
     */
    public function testRejectionCodes($bradesco)
    {
        $this->assertInternalType('array', $bradesco->rejectionCodes());
        $this->assertEquals([], $bradesco->rejectionCodes());
    }
}