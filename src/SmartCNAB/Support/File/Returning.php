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
     * @param  string  $path  path of returning file
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

        return array_map([$this, 'detailMapper'], $details);
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

        return (object) $data;
    }

    /**
     * Returns the file trailer.
     *
     * @return \StdClass
     */
    public function trailer()
    {
        $data = $this->parseLine(end($this->lines), 'trailer');

        return (object) $data;
    }

    /**
     * Mapper method for one line parsing.
     *
     * @param  string  $detail
     * @return \StdClass
     */
    protected function detailMapper($detail)
    {
        $parsed = (object) $this->parseLine($detail);

        return $parsed;
    }

    /**
     * Create and returns a new line parse mapper using received parameters.
     *
     * @param  string  $data
     * @return Closure
     */
    protected function getParseMapper($data)
    {
        return function ($meta) use ($data) {
            return $this->picture->from($meta['pic'], $data, $meta);
        };
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
        $metas = $this->schema[$type];
        $fields = array_keys($metas);

        $parsed = array_map($this->getParseMapper($data), $metas);

        return array_combine($fields, $parsed);
    }
}
