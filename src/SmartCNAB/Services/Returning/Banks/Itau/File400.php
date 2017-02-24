<?php

namespace SmartCNAB\Services\Returning\Banks\Itau;

use StdClass;

use SmartCNAB\Services\Returning\Returning;
use SmartCNAB\Support\Bank\Itau;

/**
 * Class for Itau return CNAB 400 layout.
 */
class File400 extends Returning
{
    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile = '/schemas/400.json';

    /**
     * Fetch and return motives descriptions from received detail data.
     *
     * @param  \StdClass  $data
     * @return array
     */
    public function getMotives(StdClass $data)
    {
        $map = $this->supportBank->motives($data->occurrenceCode);
        $parts = $this->parseMotiveParts($data);

        $mapper = function ($motive) use ($map) {
            return empty($map[$motive]) ? null : $map[$motive];
        };

        return array_filter(array_map($mapper, $parts));
    }

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
        $motive = $data->motive;

        if (in_array($data->occurrenceCode, Itau::OCCURRENCES_ERROR)) {
            return str_split($motive, 2);
        }

        if ($this->hasOtherMotive($data)) {
            return [$data->otherMotive];
        }

        return [$motive];
    }
}
