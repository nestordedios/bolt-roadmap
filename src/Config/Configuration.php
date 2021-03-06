<?php

declare(strict_types=1);

namespace App\Config;

use Symfony\Component\Yaml\Yaml;

class Configuration
{
    private $data = [];
    private $configFilename;
    private $dataFilename;

    public function __construct()
    {
        $this->configFilename = dirname(dirname(__DIR__)) . '/config/config.yml';
        $this->dataFilename = dirname(dirname(__DIR__)) . '/data/table.yml';
        $this->initialize();
    }

    private function initialize()
    {
        $this->config = Yaml::parseFile($this->configFilename);
        $this->data = Yaml::parseFile($this->dataFilename);
    }


    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function set(array $data)
    {
        $this->data = $data;
    }

    /**
     * Write Yaml data.
     */
    public function write()
    {
        $yaml = Yaml::dump($this->data);

        file_put_contents($this->dataFilename, $yaml);
    }
}
