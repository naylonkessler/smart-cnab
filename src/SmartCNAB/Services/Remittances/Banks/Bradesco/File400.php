<?php

namespace SmartCNAB\Services\Remittances\Banks\Bradesco;

use SmartCNAB\Support\File\Remittance;

/**
 * Class for Bradesco remittance CNAB 400 layout.
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
     * Formats the late interest flag based on late interest percentage.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */
    protected function formatDetailLateInterestFlag(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return ( ! empty($data['lateInterestPercentage']))? 2 : 0;
    }
}
