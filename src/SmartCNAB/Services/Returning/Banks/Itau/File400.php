<?php

namespace SmartCNAB\Services\Returning\Banks\Itau;

use SmartCNAB\Support\File\Returning;
use SmartCNAB\Support\Picture;

/**
 * Class for Itau return CNAB 400 layout.
 */
class File400 extends Returning
{
    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile = '/schemas/400.json';
}