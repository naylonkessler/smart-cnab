<?php

class FactoryBradescoTest extends PHPUnit_Framework_TestCase
{
    public function testRemittanceReturn()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::BRADESCO,
            \SmartCNAB\Support\File\File::CNAB400
        );

        $this->assertInstanceOf(
            \SmartCNAB\Services\Remittances\Banks\Bradesco\File400::class,
            $remittance
        );
    }

    // public function testReturningReturn()
    // {
    //     $factory = new \SmartCNAB\Services\Factory();
    //     $returning = $factory->returning(
    //         dirname(__FILE__).'/sample.RET',
    //         \SmartCNAB\Support\Bank::BRADESCO
    //     );

    //     $this->assertInstanceOf(
    //         \SmartCNAB\Services\Returning\Banks\Bradesco\File400::class,
    //         $returning
    //     );
    // }

    // public function testReturningDiscoverBank()
    // {
    //     $factory = new \SmartCNAB\Services\Factory();
    //     $returning = $factory->returning(dirname(__FILE__).'/sample.RET');

    //     $this->assertInstanceOf(
    //         \SmartCNAB\Services\Returning\Banks\Bradesco\File400::class,
    //         $returning
    //     );
    // }
}