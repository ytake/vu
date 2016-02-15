<?php

namespace Vu;

use League\Container\ContainerInterface;

/**
 * Class Dependencies
 */
class Dependencies
{
    /**
     * @param ContainerInterface $container
     */
    public function define(ContainerInterface $container)
    {
        $container->add('Relay\RelayBuilder', 'Relay\RelayBuilder');
        $container->add('Psr\Http\Message\ResponseInterface', 'Zend\Diactoros\Response');
        $container->add('Vu\Router\RouteInterface', 'Vu\Router\Route');

        $container->add('vu://router', 'Vu\Router\Router')
            ->withArgument('Vu\Router\RouteInterface');

        $container->add('vu://framework', 'Vu\Foundation\Application')
            ->withArgument('Relay\RelayBuilder');
    }
}
