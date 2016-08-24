<?php

namespace SmartCNAB\Services\Returning\Banks\Caixa;

use SmartCNAB\Support\File\Returning;

/**
 * Class for Caixa return CNAB 400 layout.
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