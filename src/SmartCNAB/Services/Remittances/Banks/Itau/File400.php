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
    protected $portfolioCodes = [
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
     * Mutates an account on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailAccount(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->mutateHeaderAccount($value, $data, $meta);
    }

    /**
     * Mutates an account DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailAccountDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->mutateHeaderAccountDv($value, $data, $meta);
    }

    /**
     * Mutates a company document type.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailCompanyDocumentType(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['companyDocument']) === 14? 2 : 1;
    }

    /**
     * Mutates a discount to date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailDiscountTo(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: $data['expiration'];
    }

    /**
     * Mutates a document type.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailDocumentType(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['document']) === 14? 2 : 1;
    }

    /**
     * Mutates a late interest date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailLateInterestDate(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: $data['expiration']->add(new \DateInterval('P1D'));
    }

    /**
     * Mutates the our number.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailOurNumber(
        $value,
        array $data = [],
        array $meta = []
    ) {
        $bypass = $this->portfolioCodes[$data['portfolio']][1] === 'D' ||
                    $data['portfolio'] == 115;

        return $bypass? $value : '';
    }

    /**
     * Mutates a portfolio code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailPortfolioCode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return ( ! empty($this->portfolioCodes[$data['portfolio']]))?
                    $this->portfolioCodes[$data['portfolio']][0] : $value;
    }

    /**
     * Mutates an account on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateHeaderAccount(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['account'])) return $value;

        return $value?: $data['account'];
    }

    /**
     * Mutates an account DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateHeaderAccountDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['accountDv'])) return $value;

        return $value?: $data['accountDv'];
    }
}
