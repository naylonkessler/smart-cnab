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
     * Formats a company inscription code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailCompanyinsccode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['companyinscnum']) == 14? 2 : 1;
    }

    /**
     * Formats a late interest date.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailLateinteresetdate(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $value?: $data['expiration']->add(new \DateInterval('P1D'));
    }

    /**
     * Formats a inscription code.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailInsccode(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return strlen($data['inscnum']) == 14? 2 : 1;
    }

    /**
     * Formats a deadline.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailDeadline(
        $value,
        array $data = [],
        array $meta = []
    ) {
        $value = $value?: 0;
        return ($data['inst1'] == 6 || $data['inst2'] == 6)? $value : 0;
    }
}
