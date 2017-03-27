<?php

namespace SmartCNAB\Services\Remittances\Banks\Santander;

use SmartCNAB\Support\File\Remittance;

/**
 * Class for Santander remittance CNAB 400 layout.
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
        return $value ?: $data['expiration']->add(new \DateInterval('P1D'));
    }

    /**
     * Mutates the late interest flag based on late interest percentage.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailLateInterestFlag(
        $value,
        array $data = []
    ) {
        return ( ! empty($data['lateInterestPercentage'])) ? 4 : 0;
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
     * Mutates a deadline.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailDeadline(
        $value,
        array $data = []
    ) {
        if ($data['instruction1'] == 6 || $data['instruction2'] == 6)
        {
            return $value ?: 0;
        }

        return !empty($data['deadline'])? $data['deadline'] : $value;
    }
}
