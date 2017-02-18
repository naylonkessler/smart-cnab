<?php

namespace SmartCNAB\Services;

use InvalidArgumentException;

use SmartCNAB\Contracts\FactoryInterface;
use SmartCNAB\Support\Bank;
use SmartCNAB\Support\File\Inspector;
use SmartCNAB\Support\Picture;

/**
 * SmartCNAB files factory
 */
class Factory implements FactoryInterface
{
    /**
     * Return an instance of a remittance.
     *
     * @param  integer  $bank
     * @param  integer  $version
     * @return \SmartCNAB\Contracts\File\RemittanceInterface
     */
    public function remittance($bank, $version)
    {
        $bankNs = $this->discoverBankNamespace($bank);
        $file = "File{$version}";
        $class = $bankNs . $file;

        return new $class(new Picture());
    }

    /**
     * Return an instance of a returning.
     *
     * @param  string  $path
     * @param  integer  $bank
     * @return \SmartCNAB\Contracts\File\Returning
     */
    public function returning($path, $bank = null)
    {
        $bank = $bank?: Inspector::bankNumberOf($path);
        $bankNs = $this->discoverBankNamespace($bank, 'Returning');
        $version = Inspector::fileVersionOf($path);
        $file = "File{$version}";
        $class = $bankNs . $file;

        return new $class($path, new Picture());
    }

    /**
     * Discover and return a bank namespace with received bank code.
     *
     * @param  integer  $bank
     * @param  string  $type  If remittance or returning
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function discoverBankNamespace($bank, $type = 'Remittances')
    {
        if ( ! Bank::isHandled($bank)) {
            throw new InvalidArgumentException('Unable to handle bank ' . $bank);
        }

        $name = Bank::nameOfNumber($bank);

        return "\SmartCNAB\Services\\{$type}\Banks\\{$name}\\";
    }
}
