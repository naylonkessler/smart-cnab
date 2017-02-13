<?php namespace SmartCNAB\Contracts\Support;

/**
 * BankSupport Interface
 */
interface BankSupportInterface
{
    /**
     * @return array
     */
    public function billing();

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
    public function emission();

    /**
     * @return array
     */
    public function postage();

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