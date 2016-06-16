<?php

namespace SmartCNAB\Support\File;

use SmartCNAB\Contracts\File\Remittance as RemittanceContract;
use SmartCNAB\Support\Picture;

/**
 * Base file class.
 */
class Remittance extends File implements RemittanceContract
{
    /**
     * File lines collection.
     *
     * @var array
     */
    protected $lines = [];

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
     * Lines sequencial.
     *
     * @var integer
     */
    protected $sequencial = 0;

    /**
     * Initialize and return a new instance.
     *
     * @param  \SmartCNAB\Support\Picture  $picture
     */
    public function __construct(Picture $picture)
    {
        $this->picture = $picture;
        $this->schema = $this->parseSchema();
    }

    /**
     * Add some detail data for file.
     *
     * @param  array  $data
     * @return self
     */
    public function addDetail(array $data)
    {
        $data = $this->increment($data);
        $data = $this->formatLine($data);
        $this->addLine($data);

        return $this;
    }

    /**
     * Add some detail data for file.
     *
     * @param  array  $data
     * @return self
     */
    protected function addLine(array $data)
    {
        $this->lines[] = $data;

        return $this;
    }

    /**
     * Set data for file header build.
     *
     * @param  array  $data
     * @return self
     */
    public function begin(array $data)
    {
        $data = $this->increment($data);
        $data = $this->formatLine($data, 'header');
        $this->addLine($data);

        return $this;
    }

    /**
     * Ends a file with trailer.
     *
     * @return self
     */
    public function end()
    {
        $data = $this->increment([]);
        $data = $this->formatLine($data, 'trailer');
        $this->addLine($data);
        $this->addLine(['']);

        return $this;
    }

    /**
     * Format the line data received using the schema.
     *
     * @param  array  $data
     * @param  string  $type
     * @return array
     */
    protected function formatLine(array $data, $type = 'detail')
    {
        $formatted = [];

        foreach ($this->schema[$type] as $field => $meta) {
            $value = empty($data[$field])? '' : $data[$field];
            $method = 'format'.ucfirst($type).ucfirst($field);

            if (method_exists($this, $method)) {
                $value = call_user_func([$this, $method], $value, $data, $meta);
            }

            $formatted[$field] = $this->picture->to($meta['pic'], $value, $meta);
        }

        return $formatted;
    }

    /**
     * Return the file lines.
     *
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
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
     * Increment and return the data.
     *
     * @param  array  $data
     * @return array
     */
    protected function increment(array $data)
    {
        $data['seq'] = ++$this->sequencial;

        return $data;
    }
}