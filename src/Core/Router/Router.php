<?php

namespace Effernet\Core\Router;

use Effernet\Core\Application\Run;
use Effernet\Core\Http\Server;

class Router{

    /**
     * The Get Request Method Const
     */
    private const METHOD_GET = "GET";

    /**
     * The Post Request Method Const
     */
    private const METHOD_POST = "POST";

    /**
     * Variable that holds server information
     * @var Server
     */
    private Server $server;

    /**
     * Variable holding path and callbacks
     * @var array
     */
    private array $container = [];

    /**
     * Router Class Constructor <br>
     * Create a new Route instance.
     * @author kadir <sanelkadir@gmail.com>
     * @package Effernet\Core
     * @link http://effernet.com/doc/core/Router/
     */
    public function __construct()
    {
        $this->server = new Server();
    }

    /**
     * Add new routes and actions to container.
     *
     * @param $method
     * @param $path
     * @param $callback
     */
    private function addPathToContainer($method, $path, $callback)
    {
        $this->container[$method][$path] = $callback;
    }

    /**
     * Register a new GET route with the router.
     *
     * @param string $path
     * @param $callback
     */
    public function get(string $path, $callback)
    {
        $this->addPathToContainer(self::METHOD_GET, $path, $callback);
    }

    /**
     * Get layout content.
     *
     * @return false|string
     */
    protected function getLayoutContent()
    {
        $layout = Run::$run->controller->layout;
        ob_start();
        include_once(ROOT_DIR . "/public/View/layout/$layout.php");
        return ob_get_clean();
    }

    /**
     * Get view content and parse parameters.
     *
     * @param $view
     * @param $params
     * @return false|string
     */
    protected function getViewContent($view, $params)
    {
        foreach ($params as $key => $value) {$$key = $value;}
        ob_start();
        include_once(ROOT_DIR . "/public/View/$view.php");
        return ob_get_clean();
    }

    /**
     * Register a new POST route with the router.
     *
     * @param string $path
     * @param $callback
     */
    public function post(string $path, $callback)
    {
        $this->addPathToContainer(self::METHOD_POST, $path, $callback);
    }

    /**
     * Render view content.
     *
     * @param $view
     * @param array $params
     * @return array|false|string|string[]
     */
    public function renderView($view, array $params = [])
    {
        $layoutContent = $this->getLayoutContent();
        $viewContent = $this->getViewContent($view, $params);
        return str_replace('{{Content}}', $viewContent, $layoutContent);
    }

    /**
     * Run the route action and get the response.
     */
    public function run()
    {
        $method = $this->server->getReqMethod();
        $uri_data = $this->server->getReqUri();
        $uri_exploded = explode('?', $uri_data);
        $uri = $uri_exploded[0];

        if (isset($this->container[$method][$uri])){
            $this->runCallback($this->container[$method][$uri]);
        }else{
            echo "<center><h1>404</h1><br><h3>Not Found</h3></center>";
        }

    }

    /**
     * Callback runner.
     *
     * @param $callback
     * @return callable
     */
    private function runCallback($callback)
    {
        // If callback is array, this method run defined class and classes methods
        if (is_array($callback)){
            Run::$run->controller = new $callback[0]();
            $callback[0] = Run::$run->controller;
        }

        // If callback is string, this block run defined view page
        if (is_string($callback)){
            $this->renderView($callback);
        }

        return call_user_func($callback, $this->server);
    }
}