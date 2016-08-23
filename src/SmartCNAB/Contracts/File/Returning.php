<?php

namespace SmartCNAB\Contracts\File;

/**
 * Returns files contract
 */
interface Returning
{
    /**
     * Return all return details.
     *
     * @return array
     */
    public function details();

    /**
     * Return the parsed schema.
     *
     * @return array
     */
    public function getSchema();

    /**
     * Returns the file header.
     *
     * @return \StdClass
     */
    public function header();

    /**
     * Returns the file trailer.
     *
     * @return \StdClass
     */
    public function trailer();
}