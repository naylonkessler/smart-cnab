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
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailAccount(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return substr($value, 0, -1);
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
     * Mutates a guarantee contract on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailGuaranteeContract(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return substr($value, 0, -1);
    }

    /**
     * Mutates a guarantee contract DV on detail.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateDetailGuaranteeContractDv(
        $value,
        array $data = [],
        array $meta = []
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
        return $this->mutateDetailBranch($value, $data, $meta);
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
        return $this->mutateDetailBranchDv($value, $data, $meta);
    }

    /**
     * Mutates a branch on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateHeaderBranch(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return substr($value, 0, -1);
    }

    /**
     * Mutates a branch DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateHeaderBranchDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['branch'])) return $value;

        return empty($data['branchDv']) ? $value : $data['branchDv'];
    }

    /**
     * Mutates a company code on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateHeaderCompanyCode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['account'])) return $value;

        return $value ?: $data['account'];
    }

    /**
     * Mutates a company code DV on header.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function mutateHeaderCompanyCodeDv(
        $value,
        array $data = [],
        array $meta = []
    ) {
        if (empty($data['account'])) return $value;

        return $value ?: $data['accountDv'];
    }
}
