<?php

class FileTest extends PHPUnit_Framework_TestCase
{
    public function testSchemaParsing()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::ITAU,
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
            \SmartCNAB\Support\Bank::ITAU,
            \SmartCNAB\Support\File\File::CNAB400
        );
        $lines = $remittance->begin([])
                                    ->addDetail([
                                        'name' => 'Any name to big that lib needs to cut it',
                                        'portfolio' => '109',
                                        'document' => '12345678900',
                                        'companyDocument' => '12345678900123',
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
            \SmartCNAB\Support\Bank::ITAU,
            \SmartCNAB\Support\File\File::CNAB400
        );
        $path = dirname(__FILE__).'/sample.REM';
        $file = $remittance->begin([])
                                    ->addDetail([
                                        'name' => 'Any name to big that lib needs to cut it',
                                        'portfolio' => '109',
                                        'document' => '12345678900',
                                        'companyDocument' => '12345678900123',
                                        'expiration' => new \DateTime(),
                                        'emission' => new \DateTime(),
                                    ])
                                    ->end()
                                    ->save($path);

        $this->assertInstanceOf(\SplFileObject::class, $file);
        $this->assertFileExists($path);
    }

    public function testReturningParsing()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $returning = $factory->returning(
            dirname(__FILE__).'/sample.RET',
            \SmartCNAB\Support\Bank::ITAU
        );
        $schema = $returning->getSchema();
        $lines = $returning->getLines();
        $header = $returning->header();
        $details = $returning->details();
        $trailer = $returning->trailer();

        $this->assertCount(3, $lines);
        $this->assertInstanceOf(\StdClass::class, $header);
        $this->assertTrue(is_array($details));
        $this->assertCount(1, $details);
        $this->assertInstanceOf(\StdClass::class, $details[0]);
        $this->assertInstanceOf(\StdClass::class, $trailer);
        $this->assertCount(count($schema['header']), (array)$header);
        $this->assertCount(count($schema['detail']), (array)$details[0]);
        $this->assertCount(count($schema['trailer']), (array)$trailer);
        $this->assertEquals(341, $header->bankCode);
        $this->assertEquals('1-21', $details[0]->companyUse);
    }

    public function testSpecialCharactersTransliterate() {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::ITAU,
            \SmartCNAB\Support\File\File::CNAB400
        );

        $details = $remittance->begin([])
                                        ->addDetail([
                                            'name' => 'testé ç .',
                                            'portfolio' => '109',
                                            'document' => '12345678900',
                                            'companyDocument' => '12345678900123',
                                            'expiration' => new \DateTime(),
                                            'emission' => new \DateTime(),
                                        ])
                                        ->end()
                                        ->getLines();

        $this->assertEquals('teste c .                     ', $details[1]['name']);
    }

    public function testCompanyDocumentType()
    {
         $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::ITAU,
            \SmartCNAB\Support\File\File::CNAB400
        );

        $details = $remittance->begin([])
                                        ->addDetail([
                                            'name' => 'Any name to big that lib needs to cut it',
                                            'portfolio' => '109',
                                            'document' => '12345678900',
                                            'companyDocument' => '12345678900123',
                                            'expiration' => new \DateTime(),
                                            'emission' => new \DateTime(),
                                        ])
                                        ->end()
                                        ->getLines();

        $this->assertArrayHasKey('companyDocumentType', $details[1]);
    }
}