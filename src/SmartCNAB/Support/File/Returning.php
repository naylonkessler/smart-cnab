<?php

namespace SmartCNAB\Support\File;

use SmartCNAB\Contracts\File\Returning as ReturningContract;
use SmartCNAB\Support\Picture;

/**
 * Base file class.
 */
class Returning extends File implements ReturningContract
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
    public function __construct(Picture $picture)
    {
        $this->picture = $picture;
        $this->schema = $this->parseSchema();
    }

    /**
     * Return all return details.
     *
     * @return array
     */
    public function details()
    {
        $data = $this->increment($data);
        $data = $this->formatLine($data);
        $this->addLine($data);

        return $this;
    }

    /**
     * Returns the file header.
     *
     * @return \StdClass
     */
    public function header()
    {
        $data = $this->increment($data);
        $data = $this->formatLine($data, 'header');
        $this->addLine($data);

        return $this;
    }

    /**
     * Returns the file trailer.
     *
     * @return \StdClass
     */
    public function trailer()
    {
        $data = $this->increment([]);
        $data = $this->formatLine($data, 'trailer');
        $this->addLine($data);
        $this->addLine(['']);

        return $this;
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
}