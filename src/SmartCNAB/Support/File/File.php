<?php

namespace SmartCNAB\Support\File;

use SmartCNAB\Contracts\File\File as FileContract;

/**
 * Base file class.
 */
class File implements FileContract
{
    /**
     * Version constants
     */
    const CNAB240 = 240;
    const CNAB400 = 400;

    /**
     * Saves a file and return it.
     *
     * @param  string $path
     * @return \SplFileObject
     */
    public function save($path)
    {
        return $this;
    }
}