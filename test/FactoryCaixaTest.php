<?php

class FactoryCaixaTest extends PHPUnit_Framework_TestCase
{
    public function testRemittanceReturn()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::CAIXA, 
            \SmartCNAB\Support\File\File::CNAB400
        );

        $this->assertInstanceOf(
            \SmartCNAB\Services\Remittances\Banks\Caixa\File400::class,
            $remittance
        );
    }

    public function testReturningReturn()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $returning = $factory->returning(
            dirname(__FILE__).'/sample.RET',
            \SmartCNAB\Support\Bank::CAIXA
        );

        $this->assertInstanceOf(
            \SmartCNAB\Services\Returning\Banks\Caixa\File400::class,
            $returning
        );
    }

    // public function testReturningDiscoverBank()
    // {
    //     $factory = new \SmartCNAB\Services\Factory();
    //     $returning = $factory->returning(dirname(__FILE__).'/sample.RET');

    //     $this->assertInstanceOf(
    //         \SmartCNAB\Services\Returning\Banks\Caixa\File400::class,
    //         $returning
    //     );
    // }
}