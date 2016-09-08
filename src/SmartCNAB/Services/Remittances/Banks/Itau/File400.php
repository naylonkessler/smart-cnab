<?php

namespace SmartCNAB\Services\Remittances\Banks\Itau;

use SmartCNAB\Support\File\Remittance;

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
     * Formats a company document type.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailCompanyDocumentType(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['companyDocumentType']) == 14? 2 : 1;
    }

    /**
     * Formats a discount to date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailDiscountTo(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: $data['expiration'];
    }

    /**
     * Formats a document type.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailDocumentType(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['document']) == 14? 2 : 1;
    }

    /**
     * Formats a late interest date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailLateInterestDate(
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
    protected function formatDetailOurNumber(
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
    protected function formatDetailPortfolioCode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return !empty($this->portCodes[$data['portfolio']])?
                    $this->portCodes[$data['portfolio']][0] : $value;
    }
}