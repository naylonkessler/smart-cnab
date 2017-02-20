<?php

class FileSantanderTest extends PHPUnit_Framework_TestCase
{
    public function testSchemaParsing()
    {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::SANTANDER,
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
            \SmartCNAB\Support\Bank::SANTANDER,
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
                                'instruction2' => 'teste',
                                'instruction1' => 'testeteste'
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
            \SmartCNAB\Support\Bank::SANTANDER,
            \SmartCNAB\Support\File\File::CNAB400
        );
        $path = dirname(__FILE__).'/sample.REM';
        $file = $remittance->begin([])
                            ->addDetail([
                                'name' => 'Any name to big that lib needs to cut it',
                                'portfolio' => '10',
                                'document' => '12345678900',
                                'companyDocument' => '12345678900123',
                                'expiration' => new \DateTime(),
                                'emission' => new \DateTime(),
                                'instruction2' => 'teste',
                                'instruction1' => 'testeteste'
                            ])
                            ->end()
                            ->save($path);

        $this->assertInstanceOf(\SplFileObject::class, $file);
        $this->assertFileExists($path);
    }

    public function testSpecialCharactersTransliterate() {
        $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::SANTANDER,
            \SmartCNAB\Support\File\File::CNAB400
        );

        $details = $remittance->begin([])
                                ->addDetail([
                                    'name' => 'áíóũé ç .                     0000000111',
                                    'portfolio' => '10',
                                    'document' => '12345678900',
                                    'companyDocument' => '12345678900123',
                                    'expiration' => new \DateTime(),
                                    'emission' => new \DateTime(),
                                    'instruction2' => 'teste',
                                    'instruction1' => 'testeteste'
                                ])
                                ->end()
                                ->getLines();

        $this->assertEquals('aioue c .                     0000000111', $details[1]['name']);
    }

    public function testCompanyDocumentType()
    {
         $factory = new \SmartCNAB\Services\Factory();
        $remittance = $factory->remittance(
            \SmartCNAB\Support\Bank::SANTANDER,
            \SmartCNAB\Support\File\File::CNAB400
        );

        $details = $remittance->begin([])
                                ->addDetail([
                                    'name' => 'Any name to big that lib needs to cut it',
                                    'portfolio' => '10',
                                    'document' => '12345678900',
                                    'companyDocument' => '12345678900123',
                                    'expiration' => new \DateTime(),
                                    'emission' => new \DateTime(),
                                    'instruction2' => 'teste',
                                    'instruction1' => 'testeteste'
                                ])
                                ->end()
                                ->getLines();

        $this->assertArrayHasKey('companyDocumentType', $details[1]);
    }


}