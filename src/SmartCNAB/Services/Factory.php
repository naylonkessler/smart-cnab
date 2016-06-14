<?php

namespace SmartCNAB\Services;

use SmartCNAB\Contracts\Factory as FactoryContract;
use SmartCNAB\Support\Picture;

/**
 * SmartCNAB files factory
 */
class Factory implements FactoryContract
{
    /**
     * Discover and return a bank namespace with received bank code.
     *
     * @param  integer  $bank
     * @param  string  $types  If remittance or returning
     * @return string
     */
    protected function discoverBankNamespace($bank, $type = 'Remittances')
    {
        if ($bank == 341) {
            return "\SmartCNAB\Services\\{$type}\Banks\Itau\\";
        }
    }

    /**
     * Return an instance of a remittance.
     *
     * @param  integer  $bank
     * @param  integer  $version
     * @return \SmartCNAB\Contracts\File\Remittance
     */
    public function remittance($bank, $version)
    {
        $bankNs = $this->discoverBankNamespace($bank);
        $file = "File{$version}";
        $class = $bankNs.$file;

        return new $class(new Picture());
    }

    /**
     * Return an instance of a returning.
     *
     * @param  string  $path
     * @return \SmartCNAB\Contracts\File\Returning
     */
    public function returning($path)
    {
        return new \StdClass();
    }
}