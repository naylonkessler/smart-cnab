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
     * Mutates an account on detail.
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function mutateDetailAccount($value)
    {
        return $value;
    }

    /**
     * Mutates an account DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailAccountDv(
        $value,
        array $data = []
    ) {
        if (empty($data['accountDv'])) return $value;

        return $value ?: $data['accountDv'];
    }

    /**
     * Mutates a branch on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailBranch(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->mutateHeaderBranch($value, $data, $meta);
    }

    /**
     * Mutates a branch DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailBranchDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $this->mutateHeaderBranchDv($value, $data, $meta);
    }

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
        if($data['discount'] == '0') return '';

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
     * Mutates a guarantee contract on detail.
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function mutateDetailGuaranteeContract($value)
    {
        return substr($value, 0, -1);
    }

    /**
     * Mutates a guarantee contract DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateDetailGuaranteeContractDv(
        $value,
        array $data = []
    ) {
        if (empty($data['guaranteeContract'])) return $value;

        return $value ?: substr($data['guaranteeContract'], -1);
    }

    /**
     * Mutates a receive branch on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailReceiveBranch(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['branch'])) return $value;

        return empty($data['branch']) ? $value : $data['branch'];
    }

    /**
     * Mutates a receive branch DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailReceiveBranchDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['branch'])) return $value;

        return empty($data['branchDv']) ? $value : $data['branchDv'];
    }

    /**
     * Mutates a branch on header.
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function mutateHeaderBranch($value)
    {
        return $value;
    }

    /**
     * Mutates a branch DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateHeaderBranchDv(
        $value,
        array $data = []
    ) {
        if (empty($data['branch'])) return $value;

        return empty($data['branchDv']) ? $value : $data['branchDv'];
    }

    /**
     * Mutates a company code on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateHeaderCompanyCode(
        $value,
        array $data = []
    ) {
        if (empty($data['companyCode'])) return $value;

        return $value ? substr($value, 0, -1) : substr($data['companyCode'], 0, -1);
    }

    /**
     * Mutates a company code DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @return mixed
     */
    protected function mutateHeaderCompanyCodeDv(
        $value,
        array $data = []
    ) {
        if (empty($data['companyCode'])) return $value;

        return $value ? substr($data['value'], -1) : substr($data['companyCode'], -1);
    }
}
