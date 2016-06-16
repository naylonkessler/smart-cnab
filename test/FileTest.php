<?php

class FileTest extends PHPUnit_Framework_TestCase
{
    public function testSchemaParsing()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::ITAU,
            \SmartCNAB\Support\File\File::CNAB400);
        $schema = $remittance->getSchema();

        $this->assertTrue(is_array($schema));
        $this->assertArrayHasKey('header', $schema);
        $this->assertArrayHasKey('detail', $schema);
        $this->assertArrayHasKey('trailer', $schema);
    }

    public function testLinesFormatting()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::ITAU,
            \SmartCNAB\Support\File\File::CNAB400);
        $lines = $remittance->begin([])
                    ->addDetail([
                        'portfolio' => '109',
                        'companyinscnum' => '12345678901414',
                        'inscnum' => '12345678900',
                        'expiration' => new \DateTime(),
                        'emission' => new \DateTime(),
                    ])
                    ->end()
                    ->getLines();

        $this->assertCount(4, $lines);
        $this->assertTrue(strlen(implode('', $lines[0])) == 400);
        $this->assertTrue(strlen(implode('', $lines[1])) == 400);
        $this->assertTrue(strlen(implode('', $lines[2])) == 400);
        $this->assertTrue(strlen(implode('', $lines[3])) == 0);
    }
}