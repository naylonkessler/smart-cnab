<?php

namespace SmartCNAB\Contracts\File;

/**
 * Remittances files contract
 */
interface Remittance
{
    /**
     * Add some detail data for file.
     *
     * @param  array  $data
     * @return self
     */
    public function addDetail(array $data);

    /**
     * Set data for file header build.
     *
     * @param  array  $data
     * @return self
     */
    public function begin(array $data);

    /**
     * Ends a file with trailer.
     *
     * @return self
     */
    public function end();

    /**
     * Return the parsed schema.
     *
     * @return array
     */
    public function getSchema();
}