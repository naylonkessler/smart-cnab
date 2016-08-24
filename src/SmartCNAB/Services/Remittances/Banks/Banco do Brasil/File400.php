<?php

namespace SmartCNAB\Services\Remittances\Banks\Santander;

use SmartCNAB\Support\File\Remittance;

/**
 * Class for Santander remittance CNAB 400 layout.
 */
class File400 extends Remittance
{
    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile = '/schemas/400.json';
}