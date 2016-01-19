<?php

namespace Vu\Foundation;

use Vu\Action;
use Vu\Router\Route;
use Relay\RelayBuilder;
use League\Container\Container;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Application
 */
class Application
{
    /** @var string */
    protected $path;

    /** @var string */
    protected $dependencyConfiguration = '/config/dependencies.php';

    /** @var string */
    protected $routerConfiguration = '/config/router.php';

    /** @var ContainerInterface|null */
    protected $container;

    /** @var ServerRequestInterface */
    protected $request;

    /** @var Route */
    protected $route;

    /**
     * Application constructor.
     *
     * @param string                  $path
     * @param ContainerInterface|null $container
     */
    public function __construct($path = '', ContainerInterface $container = null)
    {
        $this->path = $path;
        $this->container = $container;
    }

    /**
     * application dependency
     */
    public function setDependencies()
    {
        /** @var ContainerInterface $container */
        $container = $this->container;
        require_once $this->path . $this->dependencyConfiguration;
    }

    /**
     * @param RelayBuilder $relay
     *
     * @return $this
     */
    public function buildApplication(RelayBuilder $relay)
    {
        $this->registerCoreDependencies();
        $callable[] = $this->container->get('Vu\Router\Router');
        $callable[] = new Action($this->container);
        $next = $relay->newInstance($callable);

        return $next(
            $this->container->get(ServerRequestInterface::class),
            $this->container->get('Psr\Http\Message\ResponseInterface')
        );
    }

    /**
     * application core bindings
     * @return void
     */
    protected function registerCoreDependencies()
    {
        $dependency = new Dependency($this->container);
        $dependency->dependencyRoutes($this->route);
        $dependency->register();
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return Application
     */
    public function setRequest(ServerRequestInterface $request) : Application
    {
        $this->request = $request;
        $this->container->add(ServerRequestInterface::class, $request);

        return $this;
    }

    /**
     * @param callable $closure
     *
     * @return Application
     */
    public function routeRegister(callable $closure) : Application
    {
        $this->route = new Route;
        call_user_func($closure, $this->route);
        return $this;
    }
}
