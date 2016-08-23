<?php

namespace SmartCNAB\Support;

/**
 * Bank support class.
 */
class Bank
{
    /**
     * Bank numbers constants
     */
    const CAIXA = 104;
    const ITAU = 341;

    /**
     * Map for bank numbers and names.
     *
     * @var array
     */
    protected static $banksMap = [
        static::CAIXA => 'Caixa',
        static::ITAU => 'Itau',
    ];

    /**
     * Check if the received bank number is handled.
     *
     * @param  mixed  $number
     * @return boolean
     */
    public static function isHandled($number)
    {
        return !empty(static::$banksMap[$number]);
    }

    /**
     * Return the name of received bank number.
     *
     * @param  mixed  $number
     * @return boolean
     */
    public static function nameOfNumber($number)
    {
        return static::$banksMap[$number];
    }

    /**
     * Return a bank support instance of received bank number.
     *
     * @param  mixed  $number
     * @return object
     */
    public static function ofNumber($number)
    {
        $name = static::nameOfNumber($number);
        $class = "\SmartCNAB\Support\Bank\\{$name}";

        return new $class();
    }
}