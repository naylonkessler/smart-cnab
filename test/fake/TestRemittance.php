<?php

use SmartCNAB\Support\File\Remittance;

class TestRemittance extends Remittance
{
    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile = '/test-schema.json';

    /**
     * Generate and return the schema file path.
     *
     * @return string
     */
    protected function schemaPath()
    {
        return __DIR__ . $this->schemaFile;
    }
}
