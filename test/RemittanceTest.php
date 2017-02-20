<?php

include 'fake/TestRemittance.php';

class RemittanceTest extends PHPUnit_Framework_TestCase
{
    public function testSchemaReading()
    {
        $remittance = new TestRemittance(new \SmartCNAB\Support\Picture());
        $lines = $remittance->begin([])
                            ->addDetail([
                                'occurrenceCode' => 1,
                                'field1' => 'FIELD1',
                                'field2' => 2,
                            ])
                            ->end()
                            ->getLines();

        $this->assertTrue(is_array($lines));
        $this->assertCount(4, $lines);
        $this->assertCount(3, $lines[0]);
        $this->assertCount(6, $lines[1]);
        $this->assertCount(3, $lines[2]);
        $this->assertEquals(400, strlen(implode('', $lines[0])));
        $this->assertEquals(400, strlen(implode('', $lines[1])));
        $this->assertEquals(400, strlen(implode('', $lines[2])));
        $this->assertEquals('01', $lines[1]['occurrenceCode']);
        $this->assertEquals('FIELD1    ', $lines[1]['field1']);
        $this->assertEquals('000002', $lines[1]['field2']);
    }

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
}