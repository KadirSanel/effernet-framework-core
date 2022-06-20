<?php

namespace Effernet\Core\Router;

interface RouterInterface{

    public function get(string $path, $callback, $param = null);
    public function post(string $path, $callback, $param = null);
    public function resolve();
}