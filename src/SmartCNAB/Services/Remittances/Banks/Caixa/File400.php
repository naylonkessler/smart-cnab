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
     * @return mixed
     */
    protected function mutateDetailCompanyDocumentType(
        $value,
        array $data = []
    ) {
        return strlen($data['companyDocument']) === 14 ? 2 : 1;
    }

    /**
     * Mutates a discount to date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailDiscountTo(
        $value,
        array $data = []
    ) {
        return $value ?: $data['expiration'];
    }

    /**
     * Mutates a document type.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailDocumentType(
        $value,
        array $data = []
    ) {
        return strlen($data['document']) === 14 ? 2 : 1;
    }

    /**
     * Format instruction1 according occurrence code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailInstruction1(
        $value,
        array $data = []
    ) {
        if ($data['occurrenceCode'] == 11) return Caixa::INSTRUCTION_PROTEST;

        if ($data['occurrenceCode'] == 12) return Caixa::INSTRUCTION_DEVOLUTION;

        return $value;
    }

    /**
     * Mutates a late interest date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailLateInterestDate(
        $value,
        array $data = []
    ) {
        $returnValue = $value == '' && $data['occurrenceCode'] == 9;

        if ($returnValue) return $value;

        return $value ?: $data['expiration']->add(new \DateInterval('P1D'));
    }

    /**
     * Mutates a portfolio.
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function mutateDetailPortfolio($value)
    {
        return ($value === 'SR' ? 2 : ($value === 'RG' ? 1 : $value));
    }
}
