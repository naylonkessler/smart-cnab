<?php

include 'fake/TestReturning.php';

class ReturningTest extends PHPUnit_Framework_TestCase
{
    public function testSchemaReading()
    {
        $return = new TestReturning(
            __DIR__ . '/fixture/sample.RET',
            new \SmartCNAB\Support\Picture()
        );
        $header = $return->header();
        $details = $return->details();
        $trailer = $return->trailer();

        $this->assertInternalType('object', $header);
        $this->assertInternalType('array', $details);
        $this->assertInternalType('object', $trailer);
        $this->assertCount(20, get_object_vars($header));
        $this->assertCount(47, get_object_vars($details[0]));
        $this->assertCount(21, get_object_vars($trailer));
        $this->assertEquals(6, $details[0]->occurrenceCode);
        $this->assertInstanceOf(DateTime::class, $details[0]->occurrenceDate);
        $this->assertEquals('2013-06-20', $details[0]->occurrenceDate->format('Y-m-d'));
    }

    public function testReturningParsing()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $returning = $factory->returning(__DIR__ . '/fixture/sample.RET');
        $schema = $returning->getSchema();
        $lines = $returning->getLines();
        $header = $returning->header();
        $details = $returning->details();
        $trailer = $returning->trailer();

        $this->assertCount(6, $lines);
        $this->assertCount(4, $details);
        $this->assertEquals(341, $header->bankCode);
        $this->assertEquals('', $details[0]->companyUse);
    }

    public function testStatusGetters()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $returning = $factory->returning(__DIR__ . '/fixture/sample.RET');
        $details = $returning->details();
        $detail = $details[0];

        $this->assertObjectHasAttribute('wasAnError', $detail);
        $this->assertObjectHasAttribute('wasDischarged', $detail);
        $this->assertObjectHasAttribute('wasEntryConfirmed', $detail);
        $this->assertObjectHasAttribute('wasPaid', $detail);
        $this->assertObjectHasAttribute('wasProtested', $detail);

        return $details;
    }

    /**
     * @depends testStatusGetters
     */
    public function testWasPaidStatus($details)
    {
        $this->assertTrue($details[0]->wasPaid);
    }

    /**
     * @depends testStatusGetters
     */
    public function testWasEntryConfirmedStatus($details)
    {
        $this->assertTrue($details[2]->wasEntryConfirmed);
    }

    /**
     * @depends testStatusGetters
     */
    public function testWasDischargedStatus($details)
    {
        $this->assertTrue($details[1]->wasDischarged);
    }

    /**
     * @depends testStatusGetters
     */
    public function testWasProtestedStatus($details)
    {
        $this->assertTrue($details[3]->wasProtested);
    }
}