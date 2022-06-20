<?php
/**
 * Class Run
 * The Core Application Runner
 * @author kadir <sanelkadir@gmail.com>
 * @package Effernet\Core
 * @link http://effernet.com/doc/core/Router/
 */

namespace Effernet\Core\Application;

use Effernet\Core\Router\Router;

class Run
{
    /**
     * Controller Class
     *
     * @var Controller
     */
    public Controller $controller;

    /**
     * Router Class
     *
     * @var Router
     */
    public Router $router;

    /**
     * Run Class
     *
     * @var Run
     */
    public static Run $run;

    /**
     * Run Class Constructor <br>
     * The Core Application Runner
     * @author kadir <sanelkadir@gmail.com>
     * @package Effernet\Core
     * @link http://effernet.com/doc/core/Run/
     */
    public function __construct()
    {
        session_start();

        $this->controller = new Controller();
        $this->router = new Router();

        self::$run = $this;

    }

    /**
     * Application Starter Method
     */
    public function startApp()
    {
        $this->router->run();
    }

}