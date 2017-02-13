<?php

class BankSupportCaixaTest extends PHPUnit_Framework_TestCase
{
    public function testBankSupCaixa()
    {
        $caixa = new \SmartCNAB\Support\Bank\Caixa;

        $this->assertInstanceOf(
            \SmartCNAB\Contracts\Support\BankSupportInterface::class,
            $caixa
        );

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

    /**
     * @depends testBankSupCaixa
     */
    public function testEmission($caixa)
    {
        $this->assertInternalType('array', $caixa->emission());
    }

    /**
     * @depends testBankSupCaixa
     */
    public function testPostage($caixa)
    {
        $this->assertInternalType('array', $caixa->postage());
    }

    /**
     * @depends testBankSupCaixa
     */
    public function testBilling($caixa)
    {
        $this->assertInternalType('array', $caixa->billing());
    }
}