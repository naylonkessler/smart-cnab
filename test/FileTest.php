<?php

class FileTest extends PHPUnit_Framework_TestCase
{
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