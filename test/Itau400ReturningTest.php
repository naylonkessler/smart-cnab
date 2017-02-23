<?php

class Itau400ReturningTest extends PHPUnit_Framework_TestCase
{
    public function testReturningParsing()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $returning = $factory->returning(__DIR__ . '/fixture/itau.RET');
        $schema = $returning->getSchema();
        $lines = $returning->getLines();
        $header = $returning->header();
        $details = $returning->details();
        $trailer = $returning->trailer();

        $this->assertCount(6, $lines);
        $this->assertCount(4, $details);
        $this->assertEquals(341, $header->bankCode);

        return $returning;
    }

    /**
     * @depends testReturningParsing
     */
    public function testWasPaidStatus($returning)
    {
        $details = $returning->details();

        $this->assertTrue($details[0]->wasPaid);
        $this->assertTrue(in_array(
            $details[0]->occurrenceCode,
            \SmartCNAB\Support\Bank\Itau::OCCURRENCES_PAID
        ));
    }

    /**
     * @depends testReturningParsing
     */
    public function testWasEntryConfirmedStatus($returning)
    {
        $details = $returning->details();

        $this->assertTrue($details[1]->wasEntryConfirmed);
        $this->assertTrue(in_array(
            $details[1]->occurrenceCode,
            \SmartCNAB\Support\Bank\Itau::OCCURRENCES_ENTRY
        ));
    }

    /**
     * @depends testReturningParsing
     */
    public function testWasDischargedStatus($returning)
    {
        $details = $returning->details();

        $this->assertTrue($details[2]->wasDischarged);
        $this->assertTrue(in_array(
            $details[2]->occurrenceCode,
            \SmartCNAB\Support\Bank\Itau::OCCURRENCES_DISCHARGED
        ));
    }

    /**
     * @depends testReturningParsing
     */
    public function testWasProtestedStatus($returning)
    {
        $details = $returning->details();

        $this->assertTrue($details[3]->wasProtested);
        $this->assertTrue(in_array(
            $details[3]->occurrenceCode,
            \SmartCNAB\Support\Bank\Itau::OCCURRENCES_PROTESTED
        ));
    }
}