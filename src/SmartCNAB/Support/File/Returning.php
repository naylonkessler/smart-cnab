<?php

namespace SmartCNAB\Support\File;

use SmartCNAB\Contracts\File\ReturningInterface;
use SmartCNAB\Support\Picture;

/**
 * Base returning class.
 */
class Returning extends File implements ReturningInterface
{
    /**
     * Picture instance.
     *
     * @var \SmartCNAB\Support\Picture
     */
    protected $picture;

    /**
     * Parsed schema.
     *
     * @var array
     */
    protected $schema;

    /**
     * Initialize and return a new instance.
     *
     * @param  \SmartCNAB\Support\Picture  $picture
     */
    public function __construct($path, Picture $picture)
    {
        $this->picture = $picture;
        $this->schema = $this->parseSchema();

        $this->load($path);
    }

    /**
     * Return all return details.
     *
     * @return array
     */
    public function details()
    {
        $details = array_slice($this->lines, 1, count($this->lines) - 2);

        return array_map(function($detail) {
            return (object)$this->parseLine($detail);
        }, $details);
    }

    /**
     * Return the parsed schema.
     *
     * @return array
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Returns the file header.
     *
     * @return \StdClass
     */
    public function header()
    {
        $data = $this->parseLine($this->lines[0], 'header');

        return (object)$data;
    }

    /**
     * Parses a line data received using the schema.
     *
     * @param  string  $data
     * @param  string  $type
     * @return array
     */
    protected function parseLine($data, $type = 'detail')
    {
        $parsed = [];

        foreach ($this->schema[$type] as $field => $meta) {
            $parsed[$field] = $this->picture->from($meta['pic'], $data, $meta);
        }

        return $parsed;
    }

    /**
     * Returns the file trailer.
     *
     * @return \StdClass
     */
    public function trailer()
    {
        $data = $this->parseLine(end($this->lines), 'trailer');

        return (object)$data;
    }
}
