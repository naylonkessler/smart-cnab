<?php

namespace SmartCNAB\Support\File;

use RuntimeException;
use SplFileObject;

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
     * Generate and return the file contents.
     *
     * @return string
     */
    protected function generate()
    {
        $output = implode("\r\n", $this->getLines());
        $output = iconv('UTF-8', 'ASCII//TRANSLIT', $output);
        $output = strtoupper($output);

        return $output;
    }

    /**
     * Saves a file and return it.
     *
     * @param  string  $path
     * @return \SplFileObject
     * @throws \RuntimeException
     */
    public function save($path)
    {
        $output = $this->generate();

        if (file_put_contents($path, $output) === false) {
            throw new RuntimeException('Unable to write file '.$path);
        }

        return new SplFileObject($path);
    }
}