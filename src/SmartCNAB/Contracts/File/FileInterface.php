<?php

namespace SmartCNAB\Contracts\File;

/**
 * General files contract
 */
interface FileInterface
{
    /**
     * Return the file lines.
     *
     * @return array
     */
    public function getLines();

    /**
     * Loads a file content.
     *
     * @param  string  $path
     * @return self
     */
    public function load($path);

    /**
     * Saves a file and return it.
     *
     * @param  string  $path
     * @return \SplFileObject
     */
    public function save($path);
}
