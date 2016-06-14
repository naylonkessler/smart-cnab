<?php

namespace SmartCNAB\Contracts\File;

/**
 * General files contract
 */
interface File
{
    /**
     * Saves a file and return it.
     *
     * @param  string $path
     * @return \SplFileObject
     */
    public function save($path);
}