<?php

namespace SmartCNAB\Support\File;

use RuntimeException;
use SplFileObject;

use SmartCNAB\Contracts\File\FileInterface;

/**
 * Base file class.
 */
class File implements FileInterface
{
    /**
     * Version constants
     */
    const CNAB240 = 240;
    const CNAB400 = 400;

    /**
     * File lines collection.
     *
     * @var array
     */
    protected $lines = [];

    /**
     * File schema file.
     *
     * @var string
     */
    protected $schemaFile;

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
     * Loads a file content.
     *
     * @param  string  $path
     * @return \SmartCNAB\Support\File\File
     * @throws \RuntimeException
     */
    public function load($path)
    {
        $contents = file($path);

        if ($contents === false) {
            throw new RuntimeException('Unable to read file ' . $path);
        }

        $this->lines = $contents;

        return $this;
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
            throw new RuntimeException('Unable to write file ' . $path);
        }

        return new SplFileObject($path);
    }

    /**
     * Transform a class to a path.
     *
     * @param  string  $class
     * @return string
     */
    protected function classToPath($class)
    {
        $base = realpath(__DIR__ . '/../../..');

        return $base . '/' . dirname(str_replace('\\', '/', $class));
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
        // $output = iconv('UTF-8', 'ASCII//TRANSLIT', $output);
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
        $parsed = json_decode(file_get_contents($this->schemaPath()), true);

        if ($parsed === null) {
            throw new RuntimeException('Unable to parse schema');
        }

        return $parsed;
    }

    /**
     * Generate and return the schema file path.
     *
     * @return string
     */
    protected function schemaPath()
    {
        return realpath($this->classToPath(get_class($this)) . $this->schemaFile);
    }
}
