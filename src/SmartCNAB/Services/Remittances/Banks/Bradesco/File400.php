<?php

namespace SmartCNAB\Services\Remittances\Banks\Itau;

use SmartCNAB\Support\File\Remittance;

/**
 * Class for Itau remittance CNAB 400 layout.
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
     * Formats a late interest percentage.
     *
     * @param  mixed  $value
     * @param  array  $data
     * @param  array  $meta
     * @return mixed
     */

    protected function formatDetailLateInterestPercentage(
        $value,
        array $data = [],
        array $meta = []
    ) {
        return $data['lateInterestFlag'] == 2? $value : 0;
    }
}