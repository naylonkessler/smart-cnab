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
        return strlen($data['companyDocument']) === 14 ? 2 : 1;
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
        return $value ?: $data['expiration'];
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
        return strlen($data['document']) === 14 ? 2 : 1;
    }

    /**
     * Format instruction1 according occurrence code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailInstruction1(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if ($data['occurrenceCode'] == '11') return Caixa::INST_PROTEST;

        if ($data['occurrenceCode'] == '12') return Caixa::INST_DEVOLUTION;

        return $value;
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
        if ($value == '' && $data['occurrenceCode'] == '09')
        {
            return $value;
        }

        return $value ?: $data['expiration']->add(new \DateInterval('P1D'));
    }

    /**
     * Mutates a portfolio.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailPortfolio(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return ($value === 'SR' ? 2 : ($value === 'RG' ? 1 : $value));
    }
}
