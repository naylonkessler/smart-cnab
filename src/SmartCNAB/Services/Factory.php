<?php

namespace SmartCNAB\Services;

use InvalidArgumentException;
use RangeException;

use SmartCNAB\Contracts\FactoryInterface;
use SmartCNAB\Support\Bank;
use SmartCNAB\Support\Picture;

/**
 * SmartCNAB files factory
 */
class Factory implements FactoryInterface
{
    /**
     * Discover and return a bank namespace with received bank code.
     *
     * @param  integer  $bank
     * @param  string  $types  If remittance or returning
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function discoverBankNamespace($bank, $type = 'Remittances')
    {
        if ( ! Bank::isHandled($bank)) {
            throw new InvalidArgumentException('Unable to handle bank '.$bank);
        }

        $name = Bank::nameOfNumber($bank);

        return "\SmartCNAB\Services\\{$type}\Banks\\{$name}\\";
    }

    /**
     * Discover and return a file CNAB version.
     *
     * @param  string  $path
     * @return integer
     * @throws \RangeException
     */
    protected function discoverFileVersion($path)
    {
        $file = fopen(realpath($path), 'r');
        $header = fgets($file);
        fclose($file);

        $size = strlen(trim($header));

        if ( ! in_array($size, [240, 400])) {
            throw new RangeException('Invalid CNAB file version. Size '.$size);
        }

        return $size;
    }

    /**
     * Discover and return the bank number a file.
     *
     * @param  string  $path
     * @return integer
     */
    protected function discoverBank($path)
    {
        $file = fopen(realpath($path), 'r');
        $header = fgets($file);
        fclose($file);

        return substr($header, 76, 3);
    }

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
        $class = $bankNs.$file;

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
        $bank = $bank?: $this->discoverBank($path);
        $bankNs = $this->discoverBankNamespace($bank, 'Returning');
        $version = $this->discoverFileVersion($path);
        $file = "File{$version}";
        $class = $bankNs.$file;

        return new $class($path, new Picture());
    }
}
