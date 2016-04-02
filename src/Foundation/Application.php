<?php

namespace Vu\Foundation;

use Relay\RelayBuilder;
use Vu\Context\AnnotationConfigContext;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Container\ContainerInterface;

/**
 * Class Framework
 */
class Application
{
    /** @var array */
    protected $applicationMiddleware = [
        'vu://router', // route dispatch
    ];

    /** @var RelayBuilder */
    protected $builder;

    /** @var array */
    protected $middleware = [];

    /** @var string */
    protected $applicationDir;

    /** @var ContainerInterface  */
    protected $container;

    /**
     * Application constructor.
     *
     * @param RelayBuilder       $builder
     * @param ContainerInterface $container
     * @param string             $applicationDir
     */
    public function __construct(RelayBuilder $builder, ContainerInterface $container, $applicationDir = __DIR__)
    {
        $this->builder = $builder;
        $this->container = $container;
        $this->applicationDir = $applicationDir;
    }

    protected function webEnvironment()
    {
        $dotenv = new ConfigureEnvironment(new \Dotenv\Dotenv($this->applicationDir));
    }

    /**
     * @param $middleWare
     */
    public function middleware($middleWare)
    {
        $this->middleware[] = $middleWare;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return mixed
     */
    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->applicationBootstrap();
        $callable = $this->builder->newInstance($this->registerApplicationMiddleware());

        $response = $callable($request, $response);
        /** @var \Zend\Diactoros\Response\EmitterInterface $emitter */
        $emitter = $this->container->get('Vu\Response\AbstractEmitter')->getEmitter();
        $emitter->emit($response);
    }

    protected function applicationBootstrap()
    {
        (new AnnotationConfigContext)->register();
    }

    /**
     * @return \stdClass[]
     */
    protected function registerApplicationMiddleware() : array
    {
        $queue = [];
        $middlewares = array_merge($this->middleware, $this->applicationMiddleware);
        foreach ($middlewares as $middleware) {
            $queue[] = $this->container->get($middleware);
        }
        return $queue;
    }
}
