<?php

namespace Vu;

use Relay\RelayBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Framework
 */
class Framework
{
    /** @var RelayBuilder */
    protected $builder;

    /** @var array  */
    protected $middleware = [];

    /**
     * Framework constructor.
     *
     * @param RelayBuilder $builder
     */
    public function __construct(RelayBuilder $builder)
    {
        $this->builder = $builder;
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
     * @return mixed
     */
    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        $relay = $this->builder->newInstance($this->middleware);

        return $relay($request, $response);
    }
}
