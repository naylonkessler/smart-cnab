<?php

namespace SmartCNAB\Contracts;

/**
 * SmartCNAB files factory contract
 */
interface Factory
{
    /**
     * Return an instance of a remittance.
     *
     * @param  integer  $bank
     * @param  integer  $version
     * @return \SmartCNAB\Contracts\File\Remittance
     */
    public function remittance($bank, $version);

    /**
     * Return an instance of a returning.
     *
     * @param  string  $path
     * @return \SmartCNAB\Contracts\File\Returning
     */
    public function returning($path);
}