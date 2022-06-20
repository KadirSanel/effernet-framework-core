<?php

namespace Effernet\Core\Config;

class Config
{
    /**
     * @var string
     */
    private string $config;

    /**
     * @param string $config
     */
    public function __construct(string $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return require_once ROOT_DIR . "/config/$this->config.php";
    }

    /**
     * @param string $config
     */
    public function setConfig(string $config): void
    {
        $this->config = $config;
    }
}