<?php

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Vu\Router\Router  */
    protected $router;

    protected function setUp()
    {
        parent::setUp();
        $this->router = new \Vu\Router\Router(
            new \Vu\Router\Route()
        );
    }

    public function testRouterInvoke()
    {
        $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals();
        $response = new \Zend\Diactoros\Response;
        $router = $this->router;
        $callable = $router(
            $request,
            $response,
            function () { return 'testing'; }
        );
        $emitter = new \Zend\Diactoros\Response\SapiEmitter();
        $this->assertNull($callable);
    }
}