<?php

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Vu\Foundation\Application */
    private $app;

    protected function setUp()
    {
        $this->app = new \Vu\Foundation\Application(
            __DIR__,
            new \League\Container\Container
        );
    }

    public function testSetRequestInstance()
    {
        $app = $this->app->setRequest(\Zend\Diactoros\ServerRequestFactory::fromGlobals());
        $this->assertInstanceOf(get_class($this->app), $app);
    }

    public function testShouldBeApplicationInstanceAtBuild()
    {
        /** @var  $app */
        $app = $this->app->setRequest(\Zend\Diactoros\ServerRequestFactory::fromGlobals());
        $applicationRoute = $app->routeRegister(function(\Vu\Router\Route $route) {
            $route->get('/testing', function ($request, $response) {
                return new \Zend\Diactoros\Response\JsonResponse(['hello world']);
            });
        });
        $buildApp = $applicationRoute->buildApplication(new \Relay\RelayBuilder());
        var_dump($buildApp);
    }
}
