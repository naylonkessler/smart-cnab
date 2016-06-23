<?php

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testFactoryInstance()
    {
        $factory = new \SmartCNAB\Services\Factory();

        $this->assertInstanceOf(\SmartCNAB\Services\Factory::class, $factory);
    }

    public function testRemittanceReturn()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::ITAU,
            \SmartCNAB\Support\File\File::CNAB400
        );

        $this->assertInstanceOf(
            \SmartCNAB\Services\Remittances\Banks\Itau\File400::class,
            $remittance
        );
    }

    public function testReturningReturn()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $returning = $factory->returning(
            dirname(__FILE__).'/sample.RET',
            \SmartCNAB\Support\Bank::ITAU
        );

        $this->assertInstanceOf(
            \SmartCNAB\Services\Returning\Banks\Itau\File400::class,
            $returning
        );
    }

    public function testReturningDiscoverBank()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $returning = $factory->returning(dirname(__FILE__).'/sample.RET');

        $this->assertInstanceOf(
            \SmartCNAB\Services\Returning\Banks\Itau\File400::class,
            $returning
        );
    }
}