<?php

namespace Vu\Foundation;

use Vu\Router\Router;
use Vu\Router\RouteInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Container\ContainerInterface as Container;

/**
 * Class Dependency
 */
class Dependency
{
    /** @var Container */
    protected $container;

    /**
     * Dependency constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param RouteInterface $route
     */
    public function dependencyRoutes(RouteInterface $route)
    {
        $this->container->add(RouteInterface::class, $route);
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->container->add(ResponseInterface::class, \Zend\Diactoros\Response::class);
        $this->container->add(Router::class, function () {
            return new Router($this->container->get(RouteInterface::class));
        });
    }
}
