<?php

namespace SmartCNAB\Support\File;

use SmartCNAB\Contracts\File\RemittanceInterface;
use SmartCNAB\Support\Picture;

/**
 * Base remittances class.
 */
class Remittance extends File implements RemittanceInterface
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
     * Lines sequential.
     *
     * @var integer
     */
    protected $sequential = 0;

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
     * @return \SmartCNAB\Support\File\Remittance
     */
    public function addDetail(array $data)
    {
        $data = $this->increment($data);
        $data = $this->formatLine($data);
        $this->addLine($data);

        return $this;
    }

    /**
     * Set data for file header build.
     *
     * @param  array  $data
     * @return \SmartCNAB\Support\File\Remittance
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
     * @return \SmartCNAB\Support\File\Remittance
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
     * Return the parsed schema.
     *
     * @return array
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Add some detail data for file.
     *
     * @param  array  $data
     * @return \SmartCNAB\Support\File\Remittance
     */
    protected function addLine(array $data)
    {
        $this->lines[] = $data;

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
        $metas = $this->schema[$type];
        $fields = array_keys($this->schema[$type]);

        $formatted = array_map(
            $this->getFormatMapper($data, $type),
            $metas,
            $fields
        );

        return array_combine($fields, $formatted);
    }

    /**
     * Create and returns a new line format mapper using received parameters.
     *
     * @param  array  $data
     * @param  string  $type
     * @return Closure
     */
    protected function getFormatMapper(array $data, $type)
    {
        return function ($meta, $field) use ($data, $type) {
            $value = empty($data[$field])? '' : $data[$field];
            $method = 'mutate' . ucfirst($type) . ucfirst($field);

            if (method_exists($this, $method)) {
                $value = call_user_func([$this, $method], $value, $data, $meta);
            }

            return $this->picture->to($meta['pic'], $value, $meta);
        };
    }

    /**
     * Increment and return the data.
     *
     * @param  array  $data
     * @return array
     */
    protected function increment(array $data)
    {
        $data['sequential'] = ++$this->sequential;

        return $data;
    }
}
