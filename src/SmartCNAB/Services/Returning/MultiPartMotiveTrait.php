<?php

namespace SmartCNAB\Services\Returning;

use StdClass;

/**
 * Trait for mixin code that supports motive information with more than one part.
 */
trait MultiPartMotiveTrait
{
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
}
