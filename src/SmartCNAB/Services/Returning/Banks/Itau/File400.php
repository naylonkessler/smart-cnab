<?php

namespace SmartCNAB\Services\Returning\Banks\Itau;

use StdClass;

use SmartCNAB\Services\Returning\MultiPartMotiveTrait;
use SmartCNAB\Services\Returning\Returning;
use SmartCNAB\Support\Bank\Itau;

/**
 * Class for Itau return CNAB 400 layout.
 */
class File400 extends Returning
{
    use MultiPartMotiveTrait;

    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile = '/schemas/400.json';

    /**
     * Check if received data as other motive set.
     *
     * @param  \StdClass  $data
     * @return boolean
     */
    protected function hasOtherMotive(StdClass $data)
    {
        $others = array_merge(
            Itau::OCCURRENCES_INSTRUCTION_CANCELED,
            Itau::OCCURRENCES_PAYER_CLAIMS,
            Itau::OCCURRENCES_PROTEST_ORDER_HALTED
        );

        return in_array($data->occurrenceCode, $others);
    }

    /**
     * Parse the motive parts from received motive.
     *
     * @param  \StdClass  $data
     * @return array
     */
    protected function parseMotiveParts(StdClass $data)
    {
        $motive = str_pad(trim($data->motive), 8, 0, STR_PAD_LEFT);

        if (in_array($data->occurrenceCode, Itau::OCCURRENCES_ERROR)) {
            return str_split($motive, 2);
        }

        if ($this->hasOtherMotive($data)) {
            return [$data->otherMotive];
        }

        return [$motive];
    }
}
