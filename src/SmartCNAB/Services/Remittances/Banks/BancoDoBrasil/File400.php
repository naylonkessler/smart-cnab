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
     * Formats an account DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailAccountDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->formatHeaderAccountDv($value, $data, $meta);
    }

    /**
     * Formats a branch DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailBranchDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->formatHeaderBranchDv($value, $data, $meta);
    }

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
        return strlen($data['companyDocumentType']) === 14? 2 : 1;
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
     * Formats an account DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatHeaderAccountDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: substr($data['account'], -1);
    }

    /**
     * Formats a branch DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatHeaderBranchDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: substr($data['branch'], -1);
    }
}