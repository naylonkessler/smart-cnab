<?php

class FileCaixaTest extends PHPUnit_Framework_TestCase
{
    public function testSchemaParsing()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::CAIXA,
            \SmartCNAB\Support\File\File::CNAB400
        );
        $schema = $remittance->getSchema();

        $this->assertTrue(is_array($schema));
        $this->assertArrayHasKey('header', $schema);
        $this->assertArrayHasKey('detail', $schema);
        $this->assertArrayHasKey('trailer', $schema);
    }

    public function testRemittanceLinesFormatting()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::CAIXA,
            \SmartCNAB\Support\File\File::CNAB400
        );
        $lines = $remittance->begin([])
                            ->addDetail([
                                'name' => 'Qualquer nome grande o sucifiente para a lib ter que cortar',
                                'portfolio' => '109',
                                'document' => '01234567890',
                                'companyDocument' => '01234567890123',
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

    public function testRemittanceSaving()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::CAIXA,
            \SmartCNAB\Support\File\File::CNAB400
        );
        $path = dirname(__FILE__).'/sample.REM';
        $file = $remittance->begin([])
                            ->addDetail([
                                'name' => 'Qualquer nome grande o sucifiente para a lib ter que cortar',
                                'portfolio' => '109',
                                'document' => '01234567890',
                                'companyDocument' => '01234567890123',
                                'expiration' => new \DateTime(),
                                'emission' => new \DateTime(),
                            ])
                            ->end()
                            ->save($path);

        $this->assertInstanceOf(\SplFileObject::class, $file);
        $this->assertFileExists($path);
    }

    // public function testReturningParsing()
    // {
    //     $factory = new \SmartCNAB\Services\Factory();
    //     $returning = $factory->returning(
    //         dirname(__FILE__).'/sample.RET',
    //         \SmartCNAB\Support\Bank::CAIXA
    //     );
    //     $schema = $returning->getSchema();
    //     $lines = $returning->getLines();
    //     $header = $returning->header();
    //     $details = $returning->details();
    //     $trailer = $returning->trailer();

    //     $this->assertCount(3, $lines);
    //     $this->assertInstanceOf(\StdClass::class, $header);
    //     $this->assertTrue(is_array($details));
    //     $this->assertCount(1, $details);
    //     $this->assertInstanceOf(\StdClass::class, $details[0]);
    //     $this->assertInstanceOf(\StdClass::class, $trailer);
    //     $this->assertCount(count($schema['header']), (array)$header);
    //     $this->assertCount(count($schema['detail']), (array)$details[0]);
    //     $this->assertCount(count($schema['trailer']), (array)$trailer);
    //     $this->assertEquals(104, $header->bankCode);
    //     $this->assertEquals('1-21', $details[0]->companyUse);
    // }
}