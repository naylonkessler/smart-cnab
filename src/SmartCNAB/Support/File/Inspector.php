<?php

namespace SmartCNAB\Support\File;

use RangeException;

/**
 * Files inspector.
 * Grab some util informations about files.
 */
class Inspector
{
    /**
     * Discover and return the bank number a file.
     *
     * @param  string  $path
     * @return integer
     */
    public static function bankNumberOf($path)
    {
        $file = fopen(realpath($path), 'r');
        $header = fgets($file);
        fclose($file);

        return substr($header, 76, 3);
    }

    /**
     * Discover and return a file CNAB version.
     *
     * @param  string  $path
     * @return integer
     * @throws \RangeException
     */
    public static function fileVersionOf($path)
    {
        $file = fopen(realpath($path), 'r');
        $header = fgets($file);
        fclose($file);

        $size = strlen(trim($header));

        if ( ! in_array($size, [240, 400])) {
            throw new RangeException('Invalid CNAB file version. Size ' . $size);
        }

        return $size;
    }
}
