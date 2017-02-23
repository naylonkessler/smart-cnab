<?php

namespace SmartCNAB\Services\Returning;

use StdClass;

use SmartCNAB\Support\Bank;
use SmartCNAB\Support\Picture;
use SmartCNAB\Support\File\Returning as SupportReturning;

/**
 * Base service class for all returning service classes.
 * This class contains all shared logic around returning parsing rules.
 */
class Returning extends SupportReturning
{
    /**
     * Instance of bank support class.
     *
     * @var \SmartCNAB\Contracts\Support\BankSupportInterface
     */
    protected $supportBank;

    /**
     * Initialize and return a new instance.
     *
     * @param  string  $path  path of returning file
     * @param  \SmartCNAB\Support\Picture  $picture
     */
    public function __construct($path, Picture $picture)
    {
        parent::__construct($path, $picture);

        $this->supportBank = Bank::ofNumber($this->header()->bankCode);
    }

    /**
     * Fetch and return the message received on header data.
     *
     * @param  \StdClass  $data
     * @return array
     */
    public function getMessage(StdClass $data)
    {
        return [];
    }

    /**
     * Fetch and return motives descriptions from received detail data.
     *
     * @param  \StdClass  $data
     * @return array
     */
    public function getMotives(StdClass $data)
    {
        $motives = $this->supportBank->motives($data->occurrenceCode);

        return empty($motives[$motive]) ? [] : [$motives[$motive]];
    }

    /**
     * Returns the file header.
     *
     * @return \StdClass
     */
    public function header()
    {
        $data = parent::header();
        $data->message = $this->getMessage($data);

        return $data;
    }

    /**
     * Check and return if received data has some error status.
     *
     * @param  \StdClass  $data
     * @return boolean
     */
    public function wasAnError(StdClass $data)
    {
        $bank = $this->supportBank;

        return in_array($data->occurrenceCode, $bank::OCCURRENCES_ERROR);
    }

    /**
     * Check and return if received data has entry confirmed status.
     *
     * @param  \StdClass  $data
     * @return boolean
     */
    public function wasEntryConfirmed(StdClass $data)
    {
        $bank = $this->supportBank;

        return in_array($data->occurrenceCode, $bank::OCCURRENCES_ENTRY);
    }

    /**
     * Check and return if received data has discharged status.
     *
     * @param  \StdClass  $data
     * @return boolean
     */
    public function wasDischarged(StdClass $data)
    {
        $bank = $this->supportBank;

        return in_array($data->occurrenceCode, $bank::OCCURRENCES_DISCHARGED);
    }

    /**
     * Check and return if received data has paid status.
     *
     * @param  \StdClass  $data
     * @return boolean
     */
    public function wasPaid(StdClass $data)
    {
        $bank = $this->supportBank;

        return in_array($data->occurrenceCode, $bank::OCCURRENCES_PAID);
    }

    /**
     * Check and return if received data has protested status.
     *
     * @param  \StdClass  $data
     * @return boolean
     */
    public function wasProtested(StdClass $data)
    {
        $bank = $this->supportBank;

        return in_array($data->occurrenceCode, $bank::OCCURRENCES_PROTESTED);
    }

    /**
     * Specialized mapper method for one line parsing.
     *
     * @param  string  $detail
     * @return \StdClass
     */
    protected function detailMapper($detail)
    {
        $parsed = parent::detailMapper($detail);
        $parsed = $this->parseStatusAttributes($parsed);

        return $parsed;
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

    /**
     * Parsed and set the status attributes on received detail data.
     *
     * @param  \StdClass  $detail
     * @return \StdClass
     */
    protected function parseStatusAttributes(StdClass $detail)
    {
        $detail->motives = $this->getMotives($detail);
        $detail->wasAnError = $this->wasAnError($detail);
        $detail->wasDischarged = $this->wasDischarged($detail);
        $detail->wasEntryConfirmed = $this->wasEntryConfirmed($detail);
        $detail->wasPaid = $this->wasPaid($detail);
        $detail->wasProtested = $this->wasProtested($detail);

        return $detail;
    }
}
