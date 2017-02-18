<?php namespace SmartCNAB\Services\Returning;

/**
 * Base service class for all returning service classes.
 * This class contains all shared logic around returning parsing rules.
 */
class Returning
{
    /**
     * @return array
     */
    public function getMessageAttribute(array $data)
    {
    }

    /**
     * @return array
     */
    public function getMotivesAttribute(array $data)
    {
    }

    /**
     * @return boolean
     */
    public function getWasAnError(array $data)
    {
    }

    /**
     * @return boolean
     */
    public function getWasEntryConfirmedAttribute(array $data)
    {
    }

    /**
     * @return boolean
     */
    public function getWasDischargedAttribute(array $data)
    {
    }

    /**
     * @return boolean
     */
    public function getWasPaidAttribute(array $data)
    {
    }

    /**
     * @return boolean
     */
    public function getWasProtestedAttribute(array $data)
    {
    }

    /**
     * @return mixed
     */
    protected function getCustomGetter($name)
    {
    }

    /**
     * @return array
     */
    protected function parseCustomGetters()
    {
    }
}
