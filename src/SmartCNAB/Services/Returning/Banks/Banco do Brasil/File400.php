<?php

namespace SmartCNAB\Services\Returning\Banks\BancodoBrasil;

use SmartCNAB\Support\File\Returning;

/**
 * Class for BancodoBrasil return CNAB 400 layout.
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