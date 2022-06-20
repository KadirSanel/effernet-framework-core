<?php

namespace Effernet\Core\Http;

class Server
{
    /**
     * Request Method
     *
     * @var string
     */
    private string $req_method;

    /**
     * Request Uri
     *
     * @var string
     */
    private string $req_uri;

    /**
     * Server Class Constructor <br>
     * Collect and Rewrite Server Information.
     * @author kadir <sanelkadir@gmail.com>
     * @package Effernet\Core
     * @link http://effernet.com/doc/core/HTTP/Server/
     */
    public function __construct()
    {
        $this->setReqMethod();
        $this->setReqUri();
    }

    /**
     * Get request method.
     *
     * @return string
     */
    public function getReqMethod(): string
    {
        return $this->req_method;
    }

    /**
     * Get request uri.
     *
     * @return string
     */
    public function getReqUri(): string
    {
        return $this->req_uri;
    }

    /**
     * Set request method
     */
    private function setReqMethod(): void
    {
        $this->req_method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Set request uri
     */
    private function setReqUri(): void
    {
        $this->req_uri = $_SERVER['REQUEST_URI'];
    }

}