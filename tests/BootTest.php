<?php

class BootTest extends \PHPUnit_Framework_TestCase
{
    public function testBootApplication()
    {
        $dependency = new \Vu\Dependencies();
        $dependency->define($container = new \League\Container\Container());
        $boot = new \Vu\Boot(null, $container);
        $this->assertInstanceOf('Vu\Framework', $boot->instance());
    }
}
