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
     * Formats an account on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailAccount(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return substr($value, 0, -1);
    }

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
        if (empty($data['accountDv'])) return $value;

        return $value?: $data['accountDv'];
    }

    /**
     * Formats a branch on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailBranch(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->formatHeaderBranch($value, $data, $meta);
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
     * Formats a guarantee contract on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailGuaranteeContract(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return substr($value, 0, -1);
    }

    /**
     * Formats a guarantee contract DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailGuaranteeContractDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['guaranteeContract'])) return $value;

        return $value?: substr($data['guaranteeContract'], -1);
    }

    /**
     * Formats a receive branch on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailReceiveBranch(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->formatDetailBranch($value, $data, $meta);
    }

    /**
     * Formats a receive branch DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailReceiveBranchDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->formatDetailBranchDv($value, $data, $meta);
    }

    /**
     * Formats a branch on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatHeaderBranch(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return substr($value, 0, -1);
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
        if (empty($data['branch'])) return $value;

        return empty($data['branchDv'])? $value : $data['branchDv'];
    }

    /**
     * Formats a company code on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatHeaderCompanyCode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['account'])) return $value;

        return $value?: $data['account'];
    }

    /**
     * Formats a company code DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatHeaderCompanyCodeDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['account'])) return $value;

        return $value?: $data['accountDv'];
    }
}
