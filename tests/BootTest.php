<?php

use Zend\Diactoros\Response as Response;
use Zend\Diactoros\ServerRequestFactory as ServerRequestFactory;

class BootTest extends \PHPUnit_Framework_TestCase
{
    public function testBootApplication()
    {
        $dependency = new \Vu\Dependencies();
        $dependency->define($container = new \League\Container\Container());
        $boot = new \Vu\Boot(null, $container);
        $this->assertInstanceOf('Vu\Framework', $instance = $boot->instance());
        $instance->middleware($container->get('vu://router'));

        // var_dump($instance->run(ServerRequestFactory::fromGlobals(), new Response()));
    }
}
