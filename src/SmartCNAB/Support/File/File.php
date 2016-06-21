<?php

namespace SmartCNAB\Support\File;

use RuntimeException;
use SplFileObject;

use SmartCNAB\Contracts\File\File as FileContract;

/**
 * Base file class.
 */
class File implements FileContract
{
    /**
     * Version constants
     */
    const CNAB240 = 240;
    const CNAB400 = 400;

    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile;

    /**
     * Transform a class to a path.
     *
     * @param  string  $class
     * @return string
     */
    protected function classToPath($class)
    {
        $base = dirname(dirname(dirname(dirname(__FILE__))));

        return $base.'/'.dirname(str_replace('\\', '/', $class));
    }

    /**
     * Generate and return the file contents.
     *
     * @return string
     */
    protected function generate()
    {
        $lines = array_map(function ($line) {
            return implode('', $line);
        }, $this->getLines());

        $output = implode("\r\n", $lines);
        $output = iconv('UTF-8', 'ASCII//TRANSLIT', $output);
        $output = strtoupper($output);

        return $output;
    }

    /**
     * Parse and return the schema structure.
     *
     * @return array
     */
    protected function parseSchema()
    {
        return json_decode(file_get_contents($this->schemaPath()), true);
    }

    /**
     * Saves a file and return it.
     *
     * @param  string  $path
     * @return \SplFileObject
     * @throws \RuntimeException
     */
    public function save($path)
    {
        $output = $this->generate();

        if (file_put_contents($path, $output) === false) {
            throw new RuntimeException('Unable to write file '.$path);
        }

        return new SplFileObject($path);
    }

    /**
     * Generate and return the schema file path.
     *
     * @return string
     */
    protected function schemaPath()
    {
        return realpath($this->classToPath(get_class($this)).$this->schemaFile);
    }
}