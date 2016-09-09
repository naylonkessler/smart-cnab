<?php

namespace SmartCNAB\Services\Remittances\Banks\SICOOB;

use SmartCNAB\Support\File\Remittance;

/**
 * Class for SICOOB remittance CNAB 400 layout.
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
}