<?php

namespace SmartCNAB\Support\Bank;

use SmartCNAB\Contracts\Support\BankSupportInterface;

/**
 * Bank base support class.
 */
abstract class Bank implements BankSupportInterface
{
    /**
     * Channels codes.
     *
     * @var array
     */
    protected static $billing = [];

    /**
     * Channels codes.
     *
     * @var array
     */
    protected static $channels = [];

    /**
     * Prefixes of documents.
     *
     * @var array
     */
    protected static $documentsPrefixes = [];

    /**
     * Emission types.
     *
     * @var array
     */
    protected static $emission = [];

    /**
     * Especies codes.
     *
     * @var array
     */
    protected static $especies = [];

    /**
     * Billing instruction.
     *
     * @var array
     */
    protected static $instructions = [];

    /**
     * Motives codes.
     *
     * @var array
     */
    protected static $motives = [];

    /**
     * Postage types.
     *
     * @var array
     */
    protected static $postage = [];

    /**
     * Return all available rejection codes.
     *
     * @var array
     */
    protected static $rejectionCodes = [];

    /**
     * Remittance occurrences codes.
     *
     * @var array
     */
    protected static $remittanceOccurrences = [];

    /**
     * Return occurrences codes.
     *
     * @var array
     */
    protected static $returnOccurrences = [];

    /**
     * @return array
     */
    public function billing()
    {
        return static::$billing;
    }

    /**
     * Return the payment channels.
     *
     * @return array
     */
    public function channels()
    {
        return static::$channels;
    }

    /**
     * Return the default state of itau infos.
     *
     * @return \StdClass
     */
    abstract public function defaults();

    /**
     * Return all available documents prefixes.
     *
     * @return array
     */
    public function documentsPrefixes()
    {
        return static::$documentsPrefixes;
    }

    /**
     * Return all available emission.
     *
     * @return array
     */
    public function emission()
    {
        return static::$emission;
    }

    /**
     * Return all available especies.
     *
     * @return array
     */
    public function especies()
    {
        return static::$especies;
    }

    /**
     * Return all available instructions.
     *
     * @return array
     */
    public function instructions()
    {
        return static::$instructions;
    }

    /**
     * Return all motives codes.
     *
     * @param  int  $occurrenceCode
     * @return array
     */
    public function motives($occurrenceCode = null)
    {
        if ( ! $occurrenceCode) return static::$motives;

        $occurrenceCode = str_pad($occurrenceCode, 2, 0, STR_PAD_LEFT);

        return $this->findMotives($occurrenceCode);
    }

    /**
     * Return all available postage.
     *
     * @return array
     */
    public function postage()
    {
        return static::$postage;
    }

    /**
     * Return all available rejection codes.
     *
     * @return array
     */
    public function rejectionCodes()
    {
        return static::$rejectionCodes;
    }

    /**
     * Return all occurrences available for remittances.
     *
     * @return array
     */
    public function remittanceOccurrences()
    {
        return static::$remittanceOccurrences;
    }

    /**
     * Return all occurrences available for returning.
     *
     * @return array
     */
    public function returnOccurrences()
    {
        return static::$returnOccurrences;
    }

    /**
     * Find for a motive group by occurrenceCode.
     *
     * @param  int  $occurrenceCode
     * @return array
     */
    protected function findMotives($occurrenceCode)
    {
        $filter = function ($key) use ($occurrenceCode) {
            return in_array($occurrenceCode, explode(',', $key));
        };

        $motives = array_filter(static::$motives, $filter, ARRAY_FILTER_USE_KEY);

        return reset($motives);
    }
}
