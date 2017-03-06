<?php

namespace SmartCNAB\Services\Returning\Banks\Bradesco;

use SmartCNAB\Services\Returning\MultiPartMotiveTrait;
use SmartCNAB\Services\Returning\Returning;
use SmartCNAB\Support\Bank\Bradesco;

/**
 * Class for Bradesco return CNAB 400 layout.
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
     * Find for irregular motives on received motive info.
     *
     * @param  mixed  $motive
     * @return array
     */
    protected function findIrregularMotive($motive)
    {
        $filter = function ($irregular) use ($motive) {
            return strpos($motive, $irregular) !== false;
        };

        return array_filter(Bradesco::MOTIVES_DEBITS_IRREGULAR, $filter);
    }

    /**
     * Parse the motive parts for debits occurrence code.
     *
     * @param  mixed  $motive
     * @param  \StdClass  $data
     * @return array
     */
    protected function parseDebitsMotiveParts($motive, StdClass $data)
    {
        $irregular = $this->findIrregularMotive($motive);

        foreach ($irregular as $one) {
            $motive = str_replace($one, '', $motive);
        }

        $regular = str_split($motive, 2);

        return array_merge($irregular, $regular);
    }

    /**
     * Parse the motive parts from received motive.
     *
     * @param  \StdClass  $data
     * @return array
     */
    protected function parseMotiveParts(StdClass $data)
    {
        $motive = str_pad(trim($data->motive), 10, 0, STR_PAD_LEFT);

        if (in_array($data->occurrenceCode, Bradesco::OCCURRENCES_DEBITS)) {
            return $this->parseDebitsMotiveParts($motive, $data);
        }

        return str_split($motive, 2);
    }
}
