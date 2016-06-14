<?php

namespace SmartCNAB\Services\Remittances\Banks\Itau;

use SmartCNAB\Support\File\Remittance;
use SmartCNAB\Support\Picture;

/**
 * Class for Itau remittance CNAB 400 layout.
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