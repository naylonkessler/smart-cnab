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

        return $value ?: $data['account'];
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
        if (empty($data['account'])) return $value;

        return $value ?: $data['accountDv'];
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
        if (empty($data['branch'])) return $value;

        return $value ?: $data['branch'];
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

        return $value ?: $data['branchDv'];
    }
}
