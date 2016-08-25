<?php

namespace SmartCNAB\Services\Remittances\Banks\BancoDoBrasil;

use SmartCNAB\Support\File\Remittance;

/**
 * Class for Banco do Brasil remittance CNAB 400 layout.
 */
class File400 extends Remittance
{
    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile = '/schemas/400.json';

    /**
     * Formats a company inscription code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailCompanyinsccode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['companyinscnum']) === 14? 2 : 1;
    }

    /**
     * Formats a discount to date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailEmission(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: $data['expiration'];
    }

    /**
     * Formats a inscription code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailInsccode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['inscnum']) == 14? 2 : 1;
    }




}