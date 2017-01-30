<?php

class BankSupportCaixaTest extends PHPUnit_Framework_TestCase
{
    public function testBankSupCaixa()
    {
        $caixa = new \SmartCNAB\Support\Bank\Caixa;

        $this->assertInstanceOf(\SmartCNAB\Contracts\Support\BankSupport::class, $caixa);

        return $caixa;
    }

    /**
     * @depends testBankSupCaixa
     */
    public function testDocumentsPrefixes($caixa)
    {
        $this->assertInternalType('array', $caixa->documentsPrefixes());
        $this->assertEquals([], $caixa->documentsPrefixes());
    }

    /**
     * @depends testBankSupCaixa
     */
    public function testMotives($caixa)
    {
        $this->assertInternalType('array', $caixa->motives());
        $this->assertEquals([], $caixa->motives());
    }
}