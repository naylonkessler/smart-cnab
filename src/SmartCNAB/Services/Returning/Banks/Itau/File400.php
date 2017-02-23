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
        $motives = $this->supportBank->motives($data->occurrenceCode);
        $motive = $this->parseMotiveParts($data);

        $motive = array_map(function ($motive) use ($motives) {
            return empty($motives[$motive]) ? null : $motives[$motive];
        }, $motive);

        return array_filter($motive);
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

        if (in_array($data->occurrenceCode, Itau::OCCURRENCES_INSTRUCTION_CANCELED)) {
            return [$data->canceledInstruction];
        }

        return [$motive];
    }
}
