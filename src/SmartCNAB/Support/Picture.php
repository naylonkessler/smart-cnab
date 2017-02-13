<?php

namespace SmartCNAB\Support;

use DateTime;

/**
 * Picture class.
 * A picture defines a format to convert from and to it.
 */
class Picture
{
    /**
     * Format a value from a picture.
     *
     * @param  string  $picture
     * @param  mixed  $value
     * @param  array  $meta
     * @return mixed
     */
    public function from($picture, $value, array $meta = [])
    {
        $parsed = $this->parse($picture, $meta);
        $method = 'fromType'.ucfirst($parsed['info-type']);
        $start = empty($parsed['pos'])? 0 : $parsed['pos'][0] - 1;
        $value = substr($value, $start, $parsed['size']);

        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], [$value, $parsed]);
        }

        $method = $parsed['data-type'].'Trim';

        return call_user_func_array([$this, $method], [$value, $parsed['size']]);
    }

    /**
     * Execute a content limit or pad if is shorten then size.
     *
     * @param  mixed  $value
     * @param  integer  $size
     * @param  array  $meta
     * @return string
     */
    public function limit($value, $size, array $meta = [])
    {
        if (strlen($value) > $size) {
            return substr($value, 0, $size);
        }

        $method = $meta['data-type'].'Pad';

        return call_user_func_array([$this, $method], [$value, $meta['size']]);
    }

    /**
     * Execute a numeric pad (left with 0).
     *
     * @param  mixed  $number
     * @param  integer  $size
     * @return string
     */
    public function numericPad($number, $size)
    {
        $number = str_replace(['.', ','], '', $number);

        return str_pad($number, $size, 0, STR_PAD_LEFT);
    }

    /**
     * Execute a numeric pad (left with no 0).
     *
     * @param  mixed  $number
     * @return string
     */
    public function numericTrim($number)
    {
        return (int)$number;
    }

    /**
     * Parses a received picture to tokens.
     *
     * @param  string  $picture
     * @param  array  $meta
     * @return array
     */
    public function parse($picture, array $meta = [])
    {
        $parsed = array_merge($meta, [
            'data-type' => 'numeric',
            'info-type' => empty($meta['type'])? 'generic' : $meta['type'],
        ]);

        if (preg_match('/^9\((\d+?)\)$/', $picture, $match)) {
            $parsed['size'] = (int)$match[1];
        }

        if (preg_match('/^9\((\d+?)\)V9\((\d+?)\)$/', $picture, $match)) {
            $parsed['info-type'] = 'money';
            $parsed['size'] = (int)$match[1] + (int)$match[2];
            $parsed['first'] = (int)$match[1];
            $parsed['last'] = (int)$match[2];
        }

        if (preg_match('/^X\((\d+?)\)$/', $picture, $match)) {
            $parsed['data-type'] = 'string';
            $parsed['size'] = (int)$match[1];
        }

        return $parsed;
    }

    /**
     * Execute a string pad (right with spaces).
     *
     * @param  mixed  $string
     * @param  integer  $size
     * @return string
     */
    public function stringPad($string, $size)
    {
        return str_pad($string, $size, ' ');
    }

    /**
     * Execute a string trim (remove right with spaces).
     *
     * @param  mixed  $string
     * @return string
     */
    public function stringTrim($string)
    {
        return trim($string);
    }

    /**
     * Format a value to picture.
     *
     * @param  string  $picture
     * @param  mixed  $value
     * @param  array  $meta
     * @return string
     */
    public function to($picture, $value, array $meta = [])
    {
        $parsed = $this->parse($picture, $meta);
        $method = 'toType'.ucfirst($parsed['info-type']);
        $value = $this->toDefault($value, $parsed);
        $value = $this->transliterate($value);

        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], [$value, $parsed]);
        }

        return $this->limit($value, $parsed['size'], $parsed);
    }

    /**
     * Format a value from a date.
     *
     * @param  mixed  $value
     * @param  array  $meta
     * @return \DateTime
     */
    protected function fromTypeDate($value, array $meta = [])
    {
        return DateTime::createFromFormat('dmy', $value);
    }

    /**
     * Format a value from a money.
     *
     * @param  numeric  $value
     * @param  array  $meta
     * @return float
     */
    protected function fromTypeMoney($value, array $meta = [])
    {
        $value = (int)$value;
        $value = substr($value, 0, -$meta['last']).'.'.substr($value, -$meta['last']);

        return floatval($value);
    }

    /**
     * Format a value to an auto date.
     *
     * @param  mixed  $value
     * @param  array  $meta
     * @return string
     */
    protected function toAutoDate($value, array $meta = [])
    {
        return new DateTime();
    }

    /**
     * Format a value to a default value.
     *
     * @param  mixed  $value
     * @param  array  $meta
     * @return string
     */
    protected function toDefault($value, array $meta = [])
    {
        if (!empty($value)) {
            return $value;
        }

        if (!empty($meta['def'])) {
            $value = $meta['def'];

            if ($value === '@auto') {
                $method = 'toAuto'.ucfirst($meta['type']);

                method_exists($this, $method) &&
                ($value = call_user_func_array([$this, $method], [$value, $meta]));
            }
        }

        return $value;
    }

    /**
     * Format a value to a date.
     *
     * @param  mixed  $value
     * @param  array  $meta
     * @return string
     */
    protected function toTypeDate($value, array $meta = [])
    {
        $value = $value instanceOf DateTime? $value->format('dmy') : null;

        return $this->limit($value, $meta['size'], $meta);
    }

    /**
     * Format a value to a money.
     *
     * @param  numeric  $value
     * @param  array  $meta
     * @return string
     */
    protected function toTypeMoney($value, array $meta = [])
    {
        $value = number_format(floatval($value), $meta['last']);

        return $this->limit($value, $meta['size'], $meta);
    }

    /**
     * Transliterate from UTF-8 to ASCII
     *
     * @param  string  $value
     * @return string
     */
    protected function transliterate($value)
    {
        return !is_string($value)? $value : iconv('UTF-8', 'ASCII//TRANSLIT', $value);
    }
}
