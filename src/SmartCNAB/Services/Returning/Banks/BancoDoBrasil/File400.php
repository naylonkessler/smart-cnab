<?php

namespace SmartCNAB\Services\Returning\Banks\BancoDoBrasil;

use SmartCNAB\Services\Returning\Returning;

/**
 * Class for BancoDoBrasil return CNAB 400 layout.
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
