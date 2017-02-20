<?php

namespace SmartCNAB\Services\Returning\Banks\SICOOB;

use SmartCNAB\Services\Returning\Returning;

/**
 * Class for SICOOB return CNAB 400 layout.
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
