<?php

namespace SmartCNAB\Contracts\File;

/**
 * Remittances files contract.
 */
interface RemittanceInterface
{
    /**
     * Add some detail data for file.
     *
     * @param  array  $data
     * @return \SmartCNAB\Contracts\File\RemittanceInterface
     */
    public function addDetail(array $data);

    /**
     * Set data for file header build.
     *
     * @param  array  $data
     * @return \SmartCNAB\Contracts\File\RemittanceInterface
     */
    public function begin(array $data);

    /**
     * Ends a file with trailer.
     *
     * @return \SmartCNAB\Contracts\File\RemittanceInterface
     */
    public function end();

    /**
     * Return the parsed schema.
     *
     * @return array
     */
    public function getSchema();
}
