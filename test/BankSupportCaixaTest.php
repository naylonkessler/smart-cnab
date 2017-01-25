<?php

class BankSupportCaixaTest extends PHPUnit_Framework_TestCase
{
    public function testCaixa()
    {
        $caixa = new \SmartCNAB\Support\Bank\Caixa;

        $this->assertInstanceOf(\SmartCNAB\Contracts\Support\BankSupport::class, $caixa);

        return $caixa;
    }

    /**
     * @depends testCaixa
     */
    public function testDocumentsPrefixes($caixa)
    {
        $this->assertEquals([], $caixa->documentsPrefixes());
    }

    /**
     * @depends testCaixa
     */
    public function testMotives($caixa)
    {
        $this->assertEquals([], $caixa->motives());
    }
}