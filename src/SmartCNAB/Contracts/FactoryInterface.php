<?php

namespace SmartCNAB\Contracts;

/**
 * SmartCNAB files factory contract
 */
interface FactoryInterface
{
    /**
     * Return an instance of a remittance.
     *
     * @param  integer  $bank
     * @param  integer  $version
     * @return \SmartCNAB\Contracts\File\RemittanceInterface
     */
    public function remittance($bank, $version);

    /**
     * Return an instance of a returning.
     *
     * @param  string  $path
     * @param  integer  $bank
     * @return \SmartCNAB\Contracts\File\ReturningInterface
     */
    public function returning($path, $bank = null);
}
