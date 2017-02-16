<?php

namespace SmartCNAB\Services\Remittances\Banks\Caixa;

use SmartCNAB\Support\Bank\Caixa;
use SmartCNAB\Support\File\Remittance;

/**
 * Class for Caixa remittance CNAB 400 layout.
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
        return strlen($data['companyDocument']) === 14? 2 : 1;
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
        return strlen($data['document']) === 14? 2 : 1;
    }

    /**
     * Format instruction1 according occurrence code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailInstruction1(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if ($data['occurrenceCode'] == '11')
        {
            return Caixa::CODE_PROTEST;
        }

        if ($data['occurrenceCode'] == '12')
        {
            return Caixa::CODE_DEVOLUTION;
        }

        return $value;
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
     * Formats a portfolio.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailPortfolio(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return ($value === 'SR'? 2 : ($value === 'RG'? 1 : $value));
    }
}
