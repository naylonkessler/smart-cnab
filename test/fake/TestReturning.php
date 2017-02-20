<?php

use SmartCNAB\Support\File\Returning;

class TestReturning extends Returning
{
    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile = '/test-ret-schema.json';

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
