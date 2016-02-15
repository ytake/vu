<?php

namespace Vu\Foundation;

use Relay\RelayBuilder;
use Vu\Context\AnnotationConfigContext;
use Vu\Foundation\ConfigureEnvironment;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Framework
 */
class Application
{
    /** @var RelayBuilder */
    protected $builder;

    /** @var array */
    protected $middleware = [];

    /** @var string  */
    protected $applicationDir;

    /**
     * Application constructor.
     *
     * @param RelayBuilder $builder
     * @param string       $applicationDir
     */
    public function __construct(RelayBuilder $builder, $applicationDir = __DIR__)
    {
        $this->applicationBootstrap();
        $this->builder = $builder;
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
        $relay = $this->builder->newInstance($this->middleware);

        return $relay($request, $response);
    }

    protected function applicationBootstrap()
    {
        (new AnnotationConfigContext)->register();
    }
}
