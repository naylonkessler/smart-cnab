<?php

namespace SmartCNAB\Services\Remittances\Banks\Itau;

use SmartCNAB\Support\File\Remittance;
use SmartCNAB\Support\Picture;

/**
 * Class for Itau remittance CNAB 400 layout.
 */
class File400 extends Remittance
{
    /**
     * Map of portfolios codes.
     *
     * @var array
     */
    protected $portCodes = [
        '108' => ['I', 'D'],
        '180' => ['I', 'D'],
        '121' => ['I', 'D'],
        '150' => ['U', 'D'],
        '109' => ['I', 'D'],
        '191' => ['1', ''],
        '104' => ['I', 'E'],
        '188' => ['I', 'E'],
        '147' => ['E', 'E'],
        '112' => ['I', 'E'],
        '115' => ['I', 'E'],
    ];

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
        return strlen($data['companyinscnum']) == 14? 2 : 1;
    }

    /**
     * Formats a discount to date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailDiscountto(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: $data['emission'];
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

    /**
     * Formats a late interest date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailLateinteresetdate(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: $data['expiration']->add(new \DateInterval('P1D'));
    }

    /**
     * Formats the our number.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailOurnum(
        $value,
        array $data = [],
        array $meta = []
    ) {
        $bypass = $this->portCodes[$data['portfolio']][1] == 'D' ||
                    $data['portfolio'] == 115;

        return $bypass? $value : '';
    }

    /**
     * Formats a portfolio code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailPortcode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return !empty($this->portCodes[$data['portfolio']])?
                    $this->portCodes[$data['portfolio']][0] : $value;
    }
}