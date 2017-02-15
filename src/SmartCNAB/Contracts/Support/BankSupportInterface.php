<?php

namespace SmartCNAB\Contracts\Support;

/**
 * Interface for contract of all bank classes for supporting purposes.
 */
interface BankSupportInterface
{
    /**
     * Returns the available data for billing.
     *
     * @return array
     */
    public function billing();

    /**
     * Returns the available data for channels.
     *
     * @return array
     */
    public function channels();

    /**
     * Returns the default state of bank data set.
     *
     * @return array
     */
    public function defaults();

    /**
     * Returns the available data for documents prefixes.
     *
     * @return array
     */
    public function documentsPrefixes();

    /**
     * Returns the available data for emission types.
     *
     * @return array
     */
    public function emission();

    /**
     * Returns the available data for document especies.
     *
     * @return array
     */
    public function especies();

    /**
     * Returns the available data for instructions.
     *
     * @return array
     */
    public function instructions();

    /**
     * Returns the available data for general motives.
     *
     * @return array
     */
    public function motives();

    /**
     * Returns the available data for postage types.
     *
     * @return array
     */
    public function postage();

    /**
     * Returns the available data for rejection codes.
     *
     * @return array
     */
    public function rejectionCodes();

    /**
     * Returns the available data for remittance occurrences.
     *
     * @return array
     */
    public function remittanceOccurrences();

    /**
     * Returns the available data for returning occurrences.
     *
     * @return array
     */
    public function returnOccurrences();
}
