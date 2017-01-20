<?php namespace SmartCNAB\Contracts\Support;

/**
 * BankSupport Interface
 */
interface BankSupport 
{
    /**
     * @return array
     */
    public function channels();

    /**
     * @return array
     */
    public function defaults();

    /**
     * @return array
     */
    public function documentsPrefixes();

    /**
     * @return array
     */
    public function especies();

    /**
     * @return array
     */
    public function instructions();

    /**
     * @return array
     */
    public function motives();

    /**
     * @return array
     */
    public function rejectionCodes();

    /**
     * @return array
     */
    public function remittanceOccurrences();

    /**
     * @return array
     */
    public function returnOccurrences();
}